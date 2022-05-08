<?php

namespace App;

use App\Entities\Lesson;
use App\Services\Mapper\GenesToLessonsMapper;
use App\Services\Writers\WriterInterface;
use Core\ConvergenceCheckerInterface;
use Core\Population;
use Core\ReproductionAlgorithmInterface;
use Core\SelectionAlgorithmInterface;

class Kernel
{
    private int $iterationCount;
    private SelectionAlgorithmInterface $selectionAlgorithm;
    private ReproductionAlgorithmInterface $reproductionAlgorithm;
    private ConvergenceCheckerInterface $convergenceChecker;
    private GenesToLessonsMapper $mapper;
    private WriterInterface $writer;

    public function __construct(
        SelectionAlgorithmInterface $selectionAlgorithm,
        ReproductionAlgorithmInterface $reproductionAlgorithm,
        ConvergenceCheckerInterface $convergenceChecker,
        GenesToLessonsMapper $mapper,
        WriterInterface $writer
    ) {
        $this->iterationCount = 0;
        $this->selectionAlgorithm = $selectionAlgorithm;
        $this->reproductionAlgorithm = $reproductionAlgorithm;
        $this->convergenceChecker = $convergenceChecker;
        $this->mapper = $mapper;
        $this->writer = $writer;
    }

    public function handle(Population $initialPopulation): void
    {
        $population = $initialPopulation;

        $this->writer->write(
            json_encode(
                $population->getAll(),
//                JSON_PRETTY_PRINT
            )
        );

        while (!$this->convergenceChecker->check($population)) {
            $population = $this->iterate($population);
            $this->iterationCount++;

            $this->writer->write(
                json_encode(
                    $population->getAll(),
//                JSON_PRETTY_PRINT
                )
            );
        }

        $fittest = $population->get(0);

        $this->writer->write(
            json_encode(
                [
                    'iteration' => $this->iterationCount,
                    'fittest' => $fittest,
                    'lessons' => array_map(fn (Lesson $lesson) => $lesson->getId(), $this->mapper->map($fittest)),
                ],
                JSON_PRETTY_PRINT
            )
        );
    }

    private function iterate(Population $population): Population
    {
        return $this->reproductionAlgorithm->reproduce(
            $this->selectionAlgorithm->select($population)
        );
    }
}
