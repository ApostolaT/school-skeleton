<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class StrongPasswordValidator implements ValidatorInterface
{
    private const PATTERN = '/^((?=\S*?\W)(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?\d)\S{10,})$/';
    /**
     * @inheritDoc
     */
    public function validate(RegisterUserDto $dto): bool
    {
        return (preg_match($this::PATTERN, $dto->password) &&
                stripos($dto->password, $dto->firstName) === false &&
                stripos($dto->password, $dto->lastName) === false
        );
    }
}