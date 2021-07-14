<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class WeakPasswordValidator implements ValidatorInterface
{
    private const PATTERN = "/^(?:[[:lower:]]{4,255})$/";

    public function validate(RegisterUserDto $dto): bool
    {
        preg_match($this::PATTERN, $dto->password);
    }
}