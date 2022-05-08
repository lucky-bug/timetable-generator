<?php

namespace App\Services\Generators;

use App\Repositories\LessonRepository;
use Core\Population;
use Core\PopulationGeneratorInterface;

class SimplePopulationGenerator implements PopulationGeneratorInterface
{
    private RandomNumberGeneratorInterface $randomNumberGenerator;
    private LessonRepository $lessonRepository;
    private int $slots;
    private int $genesPerLesson;

    public function __construct(
        RandomNumberGeneratorInterface $randomNumberGenerator,
        LessonRepository $lessonRepository,
        int $slots,
        int $genesPerLesson
    ) {
        $this->randomNumberGenerator = $randomNumberGenerator;
        $this->lessonRepository = $lessonRepository;
        $this->slots = $slots;
        $this->genesPerLesson = $genesPerLesson;
    }

    public function generate(int $size): Population
    {
        $population = new Population();

        for ($i = 0; $i < $size; $i++) {
            $genes = '';

            for ($j = 0; $j < $this->slots; $j++) {
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
