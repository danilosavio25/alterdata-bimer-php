<?php
declare(strict_types=1);

namespace Bimer\Test;

use Bimer\AreaType;
use Bimer\Test\DataServices\AreaTypeData;

class AreaTypeTest extends ResourceTest
{
    public function setUp(): void
    {
        $this->resource = AreaType::class;
    }

    public function testGetByDescription()
    {
        $areaType = AreaTypeData::get();

        $response = $this->resource::getByDescription($areaType['description']);

        $this->assertGreaterThan(0, count($response));
    }

    public function testGetById()
    {
        $areaType = AreaTypeData::get();

        $accountInformation = $this->resource::find($areaType['id']);

        $this->assertObjectHasProperty('Identificador', $accountInformation);
    }
}
