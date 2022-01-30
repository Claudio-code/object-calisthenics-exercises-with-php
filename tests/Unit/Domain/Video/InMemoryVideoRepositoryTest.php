<?php

namespace Unit\Domain\Video;

use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Address\Address;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Email\Email;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Name\Name;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Student\Student;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\InMemoryVideoRepository;
use Claudio\ObjectCalisthenucsExercisesWithPhp\Domain\Video\Video;
use PHPUnit\Framework\TestCase;

class InMemoryVideoRepositoryTest extends TestCase
{
    public function testFindingVideosForAStudentMustFilterAgeLimit(): void
    {
        $repository = new InMemoryVideoRepository();

        // [21, 20, 19, 18, 17]
        for ($i = 21; $i >= 17; $i--) {
            $repository->add(new Video($i));
        }

        $student = $this->makeStudent();
        $videoList = $repository->videosFor($student);

        self::assertCount(3, $videoList);
    }

    private static function makeStudent(): Student
    {
        $address = new Address(
            'Rua de Exemplo',
            '71B',
            'Meu Bairro',
            'Minha Cidade',
            'Meu estado',
            'Brasil'
        );

        return new Student(
            new Email('email@example.com'),
            new \DateTimeImmutable('-19 years'),
            new Name(
                'Vinicius',
                'Dias',
            ),
            $address
        );
    }
}
