<?php
declare(strict_types=1);

namespace Bimer\Test;

use Bimer\AccountInformation;
use Bimer\Test\DataServices\AccountData;

class AccountInformationTest extends ResourceTest
{
    /**
     */
    public function setUp(): void
    {
        $this->resource = AccountInformation::class;
    }

    public function testGetByDescription()
    {
        $accountData = AccountData::get();

        $response = $this->resource::getByDescription($accountData['description']);

        $this->assertGreaterThan(0, count($response));
    }

    public function testGetById()
    {
        $accountData = AccountData::get();

        $accountInformation = $this->resource::find($accountData['id']);

        $this->assertObjectHasProperty('Identificador', $accountInformation);
    }
}
