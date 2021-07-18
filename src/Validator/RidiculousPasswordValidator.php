<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class RidiculousPasswordValidator extends StrongPasswordValidator
{
    public function validate(RegisterUserDto $dto): bool
    {
        return (parent::validate($dto) &&
                stripos($dto->password, $dto->firstName) === false &&
                stripos($dto->password, $dto->lastName) === false
        );
    }
}