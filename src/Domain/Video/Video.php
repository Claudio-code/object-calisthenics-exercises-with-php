<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Core\Enum\VideoState;

class Video
{
    public function __construct(
        private int $ageLimit = 21,
        private VideoState $visibility = VideoState::PRIVATE,
    ) {}

    public function publish(): void
    {
        $this->visibility = VideoState::PUBLIC;
    }

    public function isPublic(): bool
    {
        return $this->visibility === VideoState::PUBLIC;
    }

    public function checkIfVisibilityIsValidAndUpdateIt(VideoState $visibility): void
    {
        VideoState::checkIfVisibilityIsValidAndUpdateIt($visibility);
    }

    public function getAgeLimit(): int
    {
        return $this->ageLimit;
    }
}
