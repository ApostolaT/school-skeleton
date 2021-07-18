<?php

namespace School\Service;

use School\Validator\ValidatorCollection;
use School\Dto\RegisterUserDto;
use School\Repository\UserRepository;

class RegisterUser
{
    private ValidatorCollection $validators;
    private UserRepository $userRepository;

    public function __construct(
        ValidatorCollection $validators,
        UserRepository $userRepository
    ) {
        $this->validators = $validators;
        $this->userRepository = $userRepository;
    }

    /**
     * Returns a success array or an error message array. Also saves in the database.
     */
    public function registerUser(RegisterUserDto $dto): array
    {
        $errorLogs = [];
        foreach ($this->validators as $validator) {
            if (($result = $validator->validate($dto)) === false) {
                $errorLogs[get_class($validator)] = $result;
            }
        }

        if (count($errorLogs) != 0) {
            return $errorLogs;
        }

        $this->userRepository->save();

        return [];
    }
}