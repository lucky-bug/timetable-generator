<?php

namespace App\Services\Denormalizers;

use App\Entities\Group;

class GroupDenormalizer
{
    const KEY_NAME = 'name';
    const KEY_SIZE = 'size';

    public function mapToEntity(array $data): Group
    {
        $group = new Group();

        if (isset($data[self::KEY_NAME])) {
            $group->setName($data[self::KEY_NAME]);
        }

        if (isset($data[self::KEY_SIZE])) {
            $group->setSize($data[self::KEY_SIZE]);
        }

        return $group;
    }
}
