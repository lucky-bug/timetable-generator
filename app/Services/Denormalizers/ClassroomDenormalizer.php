<?php

namespace App\Services\Denormalizers;

use App\Entities\Classroom;

class ClassroomDenormalizer
{
    const BUILDING_INDEX = 0;
    const NUMBER_INDEX = 1;
    const TYPE_INDEX = 2;
    const CAPACITY_INDEX = 3;

    public function mapToEntity(array $data): Classroom
    {
        $classroom = new Classroom();

        if (isset($data[self::BUILDING_INDEX])) {
            $classroom->setBuilding($data[self::BUILDING_INDEX]);
        }

        if (isset($data[self::NUMBER_INDEX])) {
            $classroom->setNumber($data[self::NUMBER_INDEX]);
        }

        if (isset($data[self::CAPACITY_INDEX])) {
            $classroom->setCapacity($data[self::CAPACITY_INDEX]);
        }

        if (isset($data[self::TYPE_INDEX])) {
            $classroom->setType($data[self::TYPE_INDEX]);
        }

        return $classroom;
    }
}
