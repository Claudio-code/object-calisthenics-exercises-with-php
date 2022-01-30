<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Core\DataStructure\ListVideo;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Student\Student;
use Illuminate\Support\Collection;

class InMemoryVideoRepository implements VideoRepository
{
    public function __construct(
        private readonly ListVideo $videos = new ListVideo()
    ) {}

    public function add(Video $video): void
    {
        $this->videos->add($video);
    }

    public function videosFor(Student $student): Collection
    {
        return $this->videos->getVideosOfStudent($student);
    }
}
