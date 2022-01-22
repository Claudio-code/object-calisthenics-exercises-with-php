<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Student;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\Video;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Infra\Factories\DateTimeImmutableFactory;
use DateTimeInterface;
use Illuminate\Support\Collection;


class Student
{
    private const NINETY_DAYS = 90;
    private const ZERO_DAYS = 0;
    private Collection $watchedVideos;

    public function __construct(
        private string $email,
        private DateTimeInterface $bd,
        private string $fName,
        private string $lName,
        public string $street,
        public string $number,
        public string $province,
        public string $city,
        public string $state,
        public string $country,
    ) {
        $this->watchedVideos = Collection::empty();
        $this->setEmail($email);
    }

    public function getFullName(): string
    {
        return "{$this->fName} {$this->lName}";
    }

    private function setEmail(string $email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Invalid e-mail address');
        }
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBd(): DateTimeInterface
    {
        return $this->bd;
    }

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->put($date->format(DateTimeInterface::ATOM), $video);
    }

    public function hasAccess(): bool
    {
        return !$this->hasVideoWatched() || $this->firstVideoWatchedDateIsMoreOrEqualNinetyDays();
    }

    private function firstVideoWatchedDateIsMoreOrEqualNinetyDays(): bool
    {
        return $this->getFirstVideoWatched()
                ->diff(DateTimeImmutableFactory::makeEmpty())
                ->days < self::NINETY_DAYS;
    }

    private function hasVideoWatched(): bool
    {
        return $this->watchedVideos->count() > self::ZERO_DAYS;
    }

    private function getFirstVideoWatched(): DateTimeInterface
    {
        return $this->watchedVideos
            ->keys()
            ->sortBy(fn (string $item) => $item)
            ->map(fn (string $item) => DateTimeImmutableFactory::makeFormatAtom($item))
            ->first();
    }
}
