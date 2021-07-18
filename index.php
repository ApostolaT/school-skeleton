<?php
require __DIR__ . '/vendor/autoload.php';

use http\Client\Response;
use School\Dto\RegisterUserDto;
use School\Factory\StudentValidatorCollectionFactory;
use School\Factory\TeacherValidatorCollectionFactory;
use School\Repository\UserRepository;
use School\Service\RegisterUser;

$configuration = require __DIR__ . '/config/config.php';
//Construct the dto
//Instantiate all needed validators based on configuration
//Instantiate the repo
//Instantiate the register user service and call it
//Send back the error/succes response in JSON format

try {
    $dto = RegisterUserDto::createFromGlobals();
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}

$validatorCollection = 0;

if ($dto->type === 'S') {
    try {
        $validatorCollection = StudentValidatorCollectionFactory::createValidators($configuration);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

if ($dto->type === 'T') {
    try {
        $validatorCollection = TeacherValidatorCollectionFactory::createValidators($configuration);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

$registerService = new RegisterUser(
    $validatorCollection,
    new UserRepository()
);

$errorLogs = $registerService->registerUser($dto);

if (count($errorLogs) !== 0) {
    $response = new Response(json_encode($errorLogs));
    $response->setResponseCode(406);
    $response->setHttpVersion(1.1);
    $response->setHeader('Content-type', 'application/json');
    return $response;
}

$response = new Response(json_encode("Entity saved"));
$response->setResponseCode(201);
$response->setHttpVersion(1.1);
$response->setHeader('Content-type', 'application/json');
return $response;
