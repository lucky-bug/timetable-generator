<?php

namespace App\Services\Generators;

use App\Repositories\ClassroomRepository;
use App\Repositories\LessonRepository;
use Core\Population;
use Core\PopulationGeneratorInterface;

class SimplePopulationGenerator implements PopulationGeneratorInterface
{
    private RandomNumberGeneratorInterface $randomNumberGenerator;
    private ClassroomRepository $classroomRepository;
    private LessonRepository $lessonRepository;
    private int $slots;
    private int $genesPerLesson;

    public function __construct(
        RandomNumberGeneratorInterface $randomNumberGenerator,
        ClassroomRepository $classroomRepository,
        LessonRepository $lessonRepository,
        int $slots,
        int $genesPerLesson
    ) {
        $this->randomNumberGenerator = $randomNumberGenerator;
        $this->classroomRepository = $classroomRepository;
        $this->lessonRepository = $lessonRepository;
        $this->slots = $slots;
        $this->genesPerLesson = $genesPerLesson;
    }

    public function generate(int $size): Population
    {
        $population = new Population();
        $lessonsPerIndividual = $this->slots * $this->classroomRepository->getCount();

        for ($i = 0; $i < $size; $i++) {
            $genes = '';

            for ($j = 0; $j < $lessonsPerIndividual; $j++) {
                $genes .= str_pad(
                    base_convert($this->randomNumberGenerator->generateInt(0, $this->lessonRepository->getCount()), 10, 2),
                    $this->genesPerLesson,
                    '0',
                    STR_PAD_LEFT
                );
            }

            $population->add(
                $genes
            );
        }

        return $population;
    }
}
