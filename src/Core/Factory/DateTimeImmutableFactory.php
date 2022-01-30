<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Core\Factory;

use DateTimeImmutable;
use DateTimeInterface;

class DateTimeImmutableFactory
{
    public static function makeEmpty(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }

    public static function makeFormatAtom(string $dateAtom): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, $dateAtom);
    }
}
