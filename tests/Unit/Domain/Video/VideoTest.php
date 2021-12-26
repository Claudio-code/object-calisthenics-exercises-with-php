<?php

namespace Unit\Domain\Video;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    public function testChangeVisibilityMustWork()
    {
        $video = new Video();
        $video->checkIfVisibilityIsValidAndUpdateIt(Video::PUBLIC);

        self::assertSame(Video::PUBLIC, $video->getVisibility());
    }
}
