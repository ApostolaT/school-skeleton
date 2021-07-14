<?php
namespace School\Dto;

class RegisterUserDto
{
    public string $schoolIdentifier;
    public string $email;
    public string $firstName;
    public string $lastName;
    public string $confirmPassword;
    public string $password;
    public string $entryDate;
    public string $startDate;

    public static function createFromGlobals(): RegisterUserDto
    {
        if (isset($_POST) === false) {
            throw new \Exception('Post parameters are missing!' . PHP_EOL);
        }
        $dto                    = new self();
        $dto->schoolIdentifier  = $_POST['schoolIdentifier'];
        $dto->email             = $_POST['email'];
        $dto->firstName         = $_POST['firstName'];
        $dto->lastName          = $_POST['lastName'];
        $dto->confirmPassword   = $_POST['confirmPassword'];
        $dto->password          = $_POST['password'];
        $dto->entryDate         = $_POST['entryDate'];
        $dto->startDate         = $_POST['startDate'];

        return $dto;
    }

}