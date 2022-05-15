<?php

namespace App\Services\IO\Writers;

use App\Entities\Lesson;
use App\Repositories\ClassroomRepository;

class TimetableWriter
{
    private WriterInterface $writer;
    private ClassroomRepository $classroomRepository;

    public function __construct(WriterInterface $writer, ClassroomRepository $classroomRepository)
    {
        $this->writer = $writer;
        $this->classroomRepository = $classroomRepository;
    }

    /**
     * @param Lesson[] $lessons
     */
    public function write(array $lessons, int $weeks, int $days, int $periods): void
    {
        foreach ($this->classroomRepository->getAll() as $index => $classroom) {
            $lessonIndex = $index;
            $this->writer->writeLine($classroom);

            foreach (range(1, $weeks) as $week) {
                foreach (range(1, $periods) as $period) {
                    foreach (range(1, $days) as $day) {
                        $this->writer->write($lessons[$lessonIndex]->getId() . "\t");
                        $lessonIndex += $this->classroomRepository->getCount();
                    }

                    $this->writer->writeLine('');
                }

                $this->writer->writeLine("\n");
            }
        }
    }
}
