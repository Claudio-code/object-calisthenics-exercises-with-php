<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Email;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Validate\Validate;

class Email
{
    private readonly string $email;

    public function __construct(string $email)
    {
        Validate::validateEmail($email);
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
