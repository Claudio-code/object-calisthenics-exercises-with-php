<?php

namespace Unit\Domain\Video;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Student\Student;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\InMemoryVideoRepository;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\Video;
use PHPUnit\Framework\TestCase;

class InMemoryVideoRepositoryTest extends TestCase
{
    public function testFindingVideosForAStudentMustFilterAgeLimit()
    {
        $repository = new InMemoryVideoRepository();

        // [21, 20, 19, 18, 17]
        for ($i = 21; $i >= 17; $i--) {
            $repository->add(new Video($i));
        }

        $student = $this->createStub(Student::class);
        $student->method('getBd')->willReturn(new \DateTimeImmutable('-19 years'));

        $videoList = $repository->videosFor($student);

        self::assertCount(3, $videoList);
    }
}
