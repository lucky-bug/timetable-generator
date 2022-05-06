<?php

namespace Tests\Services\Loaders;

use App\Entities\Group;
use App\Repositories\GroupRepository;
use App\Services\Denormalizers\GroupDenormalizer;
use App\Services\Loaders\GroupsLoader;
use App\Services\Readers\CsvReader;
use PHPUnit\Framework\TestCase;

class GroupsLoaderTest extends TestCase
{
    private GroupRepository $repository;
    private GroupsLoader $loader;

    protected function setUp(): void
    {
        $this->repository = new GroupRepository();
        $this->loader = new GroupsLoader(
            new CsvReader(true),
            new GroupDenormalizer(),
            $this->repository
        );
    }

    public function testLoad()
    {
        $this->loader->load('tests/Resources/groups.csv');
        self::assertEquals(3, $this->repository->getCount());
    }

    public function testGetDataClass()
    {
        self::assertEquals(Group::class, $this->loader->getDataClass());
    }
}
