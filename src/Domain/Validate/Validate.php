<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Validate;

class Validate
{
    public static function validateEmail(string $email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            return;
        }
        throw new \InvalidArgumentException('Invalid e-mail address');
    }
}
