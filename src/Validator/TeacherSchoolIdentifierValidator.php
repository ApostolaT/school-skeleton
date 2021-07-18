<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class TeacherSchoolIdentifierValidator implements ValidatorInterface
{
    private const REGEX = '/(?:^(?:TEA|TEACH|TEACHER)-\d{4}-\w{1,3}$)/';

    public function validate(RegisterUserDto $dto): bool
    {
        return preg_match($this::REGEX, $dto->schoolIdentifier);
    }
}