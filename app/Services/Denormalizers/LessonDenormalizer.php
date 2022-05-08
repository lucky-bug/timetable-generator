<?php

namespace App\Services\Denormalizers;

use App\Entities\Lesson;

class LessonDenormalizer
{
    const KEY_NAME = 'name';
    const KEY_GROUP_ID = 'group_id';
    const KEY_TAUGHT_IN_LABORATORY = 'taught_in_laboratory';

    public function mapToEntity(array $data): Lesson
    {
        $lesson = new Lesson();

        if (isset($data[self::KEY_NAME])) {
            $lesson->setName($data[self::KEY_NAME]);
        }

        if (isset($data[self::KEY_GROUP_ID])) {
            $lesson->setGroupId($data[self::KEY_GROUP_ID]);
        }

        if (isset($data[self::KEY_TAUGHT_IN_LABORATORY])) {
            $lesson->setTaughtInLaboratory($data[self::KEY_TAUGHT_IN_LABORATORY] === '1');
        }

        return $lesson;
    }
}
