<?php

namespace Tests\Services\Calculators;

use App\Entities\Lesson;
use App\Repositories\LessonRepository;
use App\Services\Calculators\IntegrityFitnessCalculator;
use App\Services\Mapper\GenesToLessonsMapper;
use Core\FitnessCalculatorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class IntegrityFitnessCalculatorTest extends TestCase
{
    /**
     * @var GenesToLessonsMapper|MockObject
     */
    private $mockedGenesToLessonsMapper;
    /**
     * @var LessonRepository|MockObject
     */
    private $mockedLessonRepository;
    private IntegrityFitnessCalculator $fitnessCalculator;

    protected function setUp(): void
    {
        $this->mockedGenesToLessonsMapper = $this->createMock(GenesToLessonsMapper::class);
        $this->mockedLessonRepository = $this->createMock(LessonRepository::class);
        $this->fitnessCalculator = new IntegrityFitnessCalculator(
            $this->mockedGenesToLessonsMapper,
            $this->mockedLessonRepository
        );
    }

    private function createLesson(int $id): Lesson
    {
        $lesson = new Lesson();
        $lesson->setId($id);

        return $lesson;
    }

    public function provideTestCalculate(): array
    {
        return [
            [
                [
                    $this->createLesson(0),
                    $this->createLesson(0),
                    $this->createLesson(0),
                ],
                3,
                -3,
            ],
            [
                [
                    $this->createLesson(0),
                    $this->createLesson(0),
                    $this->createLesson(1),
                ],
                3,
                -1,
            ],
            [
                [
                    $this->createLesson(0),
                    $this->createLesson(1),
                    $this->createLesson(2),
                ],
                3,
                1,
            ],
            [
                [
                    $this->createLesson(1),
                    $this->createLesson(2),
                    $this->createLesson(3),
                ],
                3,
                FitnessCalculatorInterface::PERFECT_FITNESS,
            ],
        ];
    }

    /**
     * @dataProvider provideTestCalculate
     * @param Lesson[] $lessons
     */
    public function testCalculate(array $lessons, int $totalLessons, int $expectedResult): void
    {
        $this
            ->mockedGenesToLessonsMapper
            ->expects(self::once())
            ->method('map')
            ->with('')
            ->willReturn($lessons)
        ;
        $this
            ->mockedLessonRepository
            ->method('getCount')
            ->willReturn($totalLessons)
        ;

        self::assertEquals($expectedResult, $this->fitnessCalculator->calculate(''));
    }
}
