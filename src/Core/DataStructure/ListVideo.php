<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Core\DataStructure;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Student\Student;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\Video;
use Illuminate\Support\Collection;

class ListVideo
{
    public function __construct(
        private Collection $collection = new Collection()
    ) {}

    public function add(Video $video): void
    {
        $this->collection->add($video);
    }

    public function getVideosOfStudent(Student $student): Collection
    {
        $today = new \DateTimeImmutable();
        return $this->collection->filter(function (Video $video) use ($today, $student) {
            return $video->getAgeLimit() <= $student->getBd()->diff($today)->y;
        });
    }
}
