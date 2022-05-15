<?php

namespace App\Services\Denormalizers;

use App\Entities\Lesson;

class LessonDenormalizer
{
    const GROUP_INDEX = 0;
    const SIZE_INDEX = 1;
    const NAME_INDEX = 3;
    const REQUIRED_CLASSROOM_TYPE_INDEX = 5;

    public function mapToEntity(array $data): Lesson
    {
        $lesson = new Lesson();

        if (isset($data[self::GROUP_INDEX])) {
            $lesson->setGroup($data[self::GROUP_INDEX]);
        }

        if (isset($data[self::SIZE_INDEX])) {
            $lesson->setSize($data[self::SIZE_INDEX]);
        }

        if (isset($data[self::NAME_INDEX])) {
            $lesson->setName($data[self::NAME_INDEX]);
        }

        if (isset($data[self::REQUIRED_CLASSROOM_TYPE_INDEX])) {
            $lesson->setRequiredClassroomType($data[self::REQUIRED_CLASSROOM_TYPE_INDEX]);
        }

        return $lesson;
    }
}
