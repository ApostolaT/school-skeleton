<?php


namespace School\Factory;


use School\Validator\DateDifferenceValidator;
use School\Validator\EmailValidator;
use School\Validator\MediumPasswordValidator;
use School\Validator\NameValidator;
use School\Validator\RidiculousPasswordValidator;
use School\Validator\StrongPasswordValidator;
use School\Validator\TeacherSchoolIdentifierValidator;
use School\Validator\ValidatorCollection;
use School\Validator\WeakPasswordValidator;

class TeacherValidatorCollectionFactory
{
    public static function createValidators(array $config): ValidatorCollection
    {
        $validatorCollection = new ValidatorCollection();
        $validatorCollection->addValidator(new TeacherSchoolIdentifierValidator());
        $validatorCollection->addValidator(new EmailValidator($config['SCHOOL_PROVIDER_REGEX']));
        $validatorCollection->addValidator(new NameValidator());
        $validatorCollection->addValidator(new DateDifferenceValidator($config['DATE_DIFFERENCE_IN_DAYS']));
        switch ($config['PASSWORD_STRENGTH']) {
            case 'WEAK':
                $validatorCollection->addValidator(new WeakPasswordValidator());
                break;
            case 'MEDIUM':
                $validatorCollection->addValidator(new MediumPasswordValidator());
                break;
            case 'STRONG':
                $validatorCollection->addValidator(new StrongPasswordValidator());
                break;
            case 'RIDICULOUS':
                $validatorCollection->addValidator(new RidiculousPasswordValidator());
                break;
            default:
                throw new \Exception("Password validation missing" . PHP_EOL);
        }

        return $validatorCollection;
    }
}