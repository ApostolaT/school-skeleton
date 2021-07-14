<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class MediumPasswordValidator implements ValidatorInterface
{
    private const PATTERN = "/^((?=\S*?[A-Z])(?=\S*?[a-z])\w{8,})$/";

    public function validate(RegisterUserDto $dto): bool
    {
        return preg_match($this::PATTERN, $dto->password);
    }
}