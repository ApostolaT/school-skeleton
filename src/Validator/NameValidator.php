<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class NameValidator implements ValidatorInterface
{
    private const PATTERN = "/(?:^(?:\p{L}+)-?(?:\p{L})*$)/";

    public function validate(RegisterUserDto $dto): bool
    {
        return preg_match($this::PATTERN, $dto->firstName);
    }
}