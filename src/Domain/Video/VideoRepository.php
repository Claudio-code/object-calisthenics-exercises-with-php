<?php

namespace Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Student\Student;
use Illuminate\Support\Collection;

interface VideoRepository
{
    public function add(Video $video): void;
    public function videosFor(Student $student): Collection;
}
