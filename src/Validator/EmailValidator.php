<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class EmailValidator implements ValidatorInterface
{
    private array $schoolProviders;

    public function __construct(array $schoolProviders)
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
        $regex = '/(?:^[\w.-]+@(?:google|yahoo|';
        $schoolProviders = "";
        foreach ($this->schoolProviders as $value) {
            $schoolProviders .= $value . '|';
        }
        $schoolProviders = substr($schoolProviders, 0, mb_strlen($regex) - 1);
        $regex .= $schoolProviders;
        $regex .= ')\.com$)/';

        return $regex;
    }
}