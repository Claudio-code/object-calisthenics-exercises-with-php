<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Core\Enum\DaysEnum;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Core\Factory\DateTimeImmutableFactory;
use DateTimeInterface;
use Illuminate\Support\Collection;

class WatchedVideos
{
    public function __construct(
        private readonly Collection $watchedVideos = new Collection()
    ) {}

    public function addWatchedVideo(Video $video, DateTimeInterface $date): void
    {
        $this->watchedVideos->put($date->format(DateTimeInterface::ATOM), $video);
    }

    private function hasVideoWatched(): bool
    {
        return $this->watchedVideos->count() > DaysEnum::ZERO_DAYS->value;
    }

    public function hasAccess(): bool
    {
        return !$this->hasVideoWatched() || $this->firstVideoWatchedDateIsMoreOrEqualNinetyDays();
    }


    private function firstVideoWatchedDateIsMoreOrEqualNinetyDays(): bool
    {
        return $this->getFirstVideoWatched()
                ->diff(DateTimeImmutableFactory::makeEmpty())
                ->days < DaysEnum::NINETY_DAYS->value;
    }

    private function getFirstVideoWatched(): DateTimeInterface
    {
        return $this->watchedVideos
            ->keys()
            ->sortBy(fn (string $item) => $item)
            ->map(DateTimeImmutableFactory::makeFormatAtom(...))
            ->first();
    }

}
