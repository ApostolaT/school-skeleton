<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class EmailValidator implements ValidatorInterface
{
    private string $schoolProviders;

    public function __construct(string $schoolProviders)
    {
        $this->schoolProviders = $schoolProviders;
    }

    public function validate(RegisterUserDto $dto): bool
    {
        $pattern = $this->constructRegex();

        return preg_match($pattern, $dto->email);
    }

    private function constructRegex(): string
    {
        $regex = '/(?:^[\w.-]+@(?:google|yahoo|' . substr($this->schoolProviders, 1, mb_strlen($this->schoolProviders - 2));
        $regex .= ')\.com$)/';

        return $regex;
    }
}