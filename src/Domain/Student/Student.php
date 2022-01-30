<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Student;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Email\Email;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\Video;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\WatchedVideos;
use DateTimeImmutable;
use DateTimeInterface;

class Student
{
    public function __construct(
        private Email $email,
        private DateTimeInterface $brightDate,
        private string $fName,
        private string $lName,
        public string $street,
        public string $number,
        public string $province,
        public string $city,
        public string $state,
        public string $country,
        private WatchedVideos $watchedVideos = new WatchedVideos()
    ) {}

    public function getFullName(): string
    {
        return "{$this->fName} {$this->lName}";
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function age(): int
    {
        $today = new DateTimeImmutable();
        $intervalDate = $this->brightDate->diff($today);
        return $intervalDate->y;
    }

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->addWatchedVideo($video, $date);
    }

    public function hasAccess(): bool
    {
        return $this->watchedVideos->hasAccess();
    }

    public function isStudentCanAccessIsVideo(Video $video): bool
    {
        return $video->getAgeLimit() <= $this->age();
    }
}
