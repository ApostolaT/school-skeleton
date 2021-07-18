<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class StudentSchoolIdentifierValidator implements ValidatorInterface
{
    private const REGEX = '/(?:^(?:ST|STUD|STUDENT)-\d{4}-\w{2,6}$)/';

    /**
     * @inheritDoc
     */
    public function validate(RegisterUserDto $dto): bool
    {
        // TODO: Implement validate() method.
    }
}