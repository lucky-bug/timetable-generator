<?php

namespace App\Services\Loaders;

use App\Entities\Group;
use App\Repositories\GroupRepository;
use App\Services\Denormalizers\GroupDenormalizer;
use App\Services\Readers\ReaderInterface;

class GroupsLoader implements LoaderInterface
{
    private ReaderInterface $reader;
    private GroupDenormalizer $groupDenormalizer;
    private GroupRepository $groupRepository;

    public function __construct(
        ReaderInterface $reader,
        GroupDenormalizer $groupDenormalizer,
        GroupRepository $groupRepository
    ) {
        $this->reader = $reader;
        $this->groupDenormalizer = $groupDenormalizer;
        $this->groupRepository = $groupRepository;
    }

    public function load(string $filename): void
    {
        foreach ($this->reader->read($filename) as $data) {
            $this->groupRepository->store(
                $this->groupDenormalizer->mapToEntity($data)
            );
        }
    }

    public function getDataClass(): string
    {
        return Group::class;
    }
}
