<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Core\Enum;

enum VideoState: int
{
    case PUBLIC = 1;
    case PRIVATE = 2;

    public static function checkIfVisibilityIsValidAndUpdateIt(VideoState $visibility): void
    {
        if (in_array($visibility, [VideoState::PUBLIC, VideoState::PRIVATE])) {
            return;
        }
        throw new \InvalidArgumentException('Invalid visibility');
    }
}
