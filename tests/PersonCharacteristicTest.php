<?php
declare(strict_types=1);

namespace Bimer\Test;

use Bimer\Customer;
use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\Person;
use Bimer\PersonCharacteristic;
use Bimer\Test\DataServices\CharacteristicData;
use Bimer\Test\DataServices\CustomerData;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class PersonCharacteristicTest extends ResourceTest
{

    protected $personResource = null;

    protected static ?stdClass $person = null;
    protected static array $characteristicData = [];

    /**
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws GuzzleException
     * @throws BimerRequestException
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$person = Customer::create(CustomerData::get());
        self::$characteristicData = CharacteristicData::get();
    }

    public function setUp(): void
    {
        $this->personResource = Person::class;
        $this->resource = PersonCharacteristic::class;
    }

    public function testGetArray()
    {
        $response = $this->resource::all();

        $this->assertIsArray($response);
        $this->assertGreaterThan(0, count($response));
    }

    public function testBindCharacteristic()
    {
        $response = $this->personResource::bindCharacteristic(self::$person->Identificador, self::$characteristicData['Identificador']);

        $this->assertIsObject($response);
        $this->assertObjectHasProperty('Identificador', $response);
    }

    /**
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws GuzzleException
     * @throws BimerRequestException
     */
    public function testGetPersonsCharacteristics()
    {
        $response = $this->resource::all(
            ["identificadorPessoa" => self::$person->Identificador],
        );

        $this->assertIsArray($response);
        $this->assertGreaterThan(0, count($response));
    }

    /**
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws GuzzleException
     * @throws BimerRequestException
     */
    public function testUnbindPersonsCharacteristic()
    {

        $this->resource::unbindPersonCharacteristic(self::$person->Identificador, self::$characteristicData['Identificador']);

        $response = $this->resource::all(
            [
                "identificadorPessoa" => self::$person->Identificador,
                "identificadorCaracteristica" => self::$characteristicData['Identificador']
            ],
        );

        $this->assertIsArray($response);
        $this->assertCount(0, $response);
    }
}
