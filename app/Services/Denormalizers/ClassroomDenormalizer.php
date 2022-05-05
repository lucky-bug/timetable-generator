<?php

namespace App\Services\Denormalizers;

use App\Entities\Classroom;

class ClassroomDenormalizer implements DenormalizerInterface
{
    const KEY_BUILDING = 'building';
    const KEY_NUMBER = 'number';
    const KEY_CAPACITY = 'capacity';
    const KEY_IS_LABORATORY = 'is_laboratory';

    public function mapToEntity(array $data): Classroom
    {
        $classroom = new Classroom();

        if (isset($data[self::KEY_BUILDING])) {
            $classroom->setBuilding($data[self::KEY_BUILDING]);
        }

        if (isset($data[self::KEY_NUMBER])) {
            $classroom->setNumber($data[self::KEY_NUMBER]);
        }

        if (isset($data[self::KEY_CAPACITY])) {
            $classroom->setCapacity($data[self::KEY_CAPACITY]);
        }

        if (isset($data[self::KEY_IS_LABORATORY])) {
            $classroom->setLaboratory($data[self::KEY_IS_LABORATORY]);
        }

        return $classroom;
    }
}
