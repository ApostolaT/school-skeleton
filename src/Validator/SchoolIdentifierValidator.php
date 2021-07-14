<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class SchoolIdentifierValidator implements ValidatorInterface
{
    private const REGEX = '/(?:^(?:ST|STUD|STUDENT)-\d{4}-\w{2,6}$)|(?:^(?:TEA|TEACH|TEACHER)-\d{4}-\w{1,3}$)/';

    public function validate(RegisterUserDto $dto): bool
    {
        return preg_match($this::REGEX, $dto->schoolIdentifier);
    }
}