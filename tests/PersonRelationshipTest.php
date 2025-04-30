<?php
declare(strict_types=1);

namespace Bimer\Test;

use Bimer\Customer;
use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\PersonRelationship;
use Bimer\Test\DataServices\CustomerData;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class PersonRelationshipTest extends ResourceTest
{

    protected static ?stdClass $mainPerson = null;
    protected static ?stdClass $relationshipPerson = null;

    protected string $mainPersonCategoryId = '0000000005';
    protected string $relationshipPersonCategoryId = '0000000005';

    /**
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws GuzzleException
     * @throws BimerRequestException
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$mainPerson = Customer::create(CustomerData::get());
        self::$relationshipPerson = Customer::create(CustomerData::get());
    }

    public function setUp(): void
    {
        $this->resource = PersonRelationship::class;
    }

    public function testCreateRelationship()
    {
        $relationship = $this->resource::createRelationship(
            self::$mainPerson->Identificador,
            [
                "IdentificadorCategoriaPessoaPrincipal" => $this->mainPersonCategoryId,
                "IdentificadorCategoriaPessoaRelacionamento" => $this->relationshipPersonCategoryId,
                "IdentificadorCaracteristicaPessoaRelacionamento" => null,
                "IdentificadorPessoaRelacionamento" => self::$relationshipPerson->Identificador,
                "PessoaRelacionadaPrincipal" => false
            ]);

        $this->assertObjectHasProperty('IdentificadorCategoriaPessoaPrincipal', $relationship);
    }

    public function testGetByPersonId()
    {
        $response = $this->resource::getByPersonId(self::$mainPerson->Identificador);
        $this->assertNotEmpty($response);
    }

    public function testGetByPersonIdShouldFail()
    {
        $invalidPersonId = 'XXXXXX';
        $this->expectException(BimerApiException::class);
        $this->resource::getByPersonId($invalidPersonId);
    }

    public function testDelete()
    {
        $response = $this->resource::deleteRelationship(
            self::$mainPerson->Identificador,
            [
                "IdentificadorCategoriaPessoa" => $this->mainPersonCategoryId,
                "IdentificadorCategoriaPessoaRelacionamento" => $this->relationshipPersonCategoryId,
                "IdentificadorPessoaRelacionamento" => self::$relationshipPerson->Identificador,
            ]);

        $this->assertIsString($response);
        $this->assertStringContainsString('sucesso', strtolower($response));
    }

}
