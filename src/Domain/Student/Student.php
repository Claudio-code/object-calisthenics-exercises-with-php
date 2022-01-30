<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Student;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Address\Address;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Email\Email;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Name\Name;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\Video;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\WatchedVideos;
use DateTimeImmutable;
use DateTimeInterface;

class Student
{
    public function __construct(
        private readonly Email $email,
        private readonly DateTimeInterface $brightDate,
        private readonly Name $name,
        private readonly Address $address,
        private readonly WatchedVideos $watchedVideos = new WatchedVideos()
    ) {}

    public function fullName(): string
    {
        return $this->name;
    }

    public function address(): Address
    {
        return $this->address;
    }

    public function email(): string
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
        return $video->ageLimit() <= $this->age();
    }
}
