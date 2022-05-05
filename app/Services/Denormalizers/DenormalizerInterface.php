<?php

namespace App\Services\Denormalizers;

interface DenormalizerInterface
{
    public function mapToEntity(array $data);
}
