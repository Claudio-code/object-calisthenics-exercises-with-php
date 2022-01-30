<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Address;

class Address
{
    public function __construct(
        public readonly string $street,
        public readonly string $number,
        public readonly string $province,
        public readonly string $city,
        public readonly string $state,
        public readonly string $country,
    ) {}
}
