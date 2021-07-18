<?php


namespace School\Validator;


use School\Dto\RegisterUserDto;

class DateDifferenceValidator implements ValidatorInterface
{
    private string $dayDifference;

    public function __construct(string $dayDifference)
    {
        $this->dayDifference = $dayDifference;
    }

    public function validate(RegisterUserDto $dto): bool
    {
        echo "Creating dates". PHP_EOL;
        $startDate = substr($dto->startDate, 0, 19);
        $entryDate = substr($dto->entryDate, 0, 19);
        $timeZone = new \DateTimeZone(substr($dto->entryDate, 19));
        $startDate = new \DateTime($startDate, $timeZone);
        $entryDate = new \DateTime($entryDate, $timeZone);

        echo 'Start Date: ' . $startDate->format('d-m-Y H:i:s e') . PHP_EOL;
        echo 'Entry Date: ' . $entryDate->format('d-m-Y H:i:s e') . PHP_EOL;

        try {
            $dateInterval = new \DateInterval('PT' . $this->dayDifference . 'd');
            if ($entryDate->diff($startDate) <= $dateInterval) {
                return false;
            }
        } catch (\Exception $e) {
            echo $e->getMessage(). PHP_EOL;
        }

        return true;
    }
}