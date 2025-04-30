<?php
declare(strict_types=1);

namespace Bimer\Test;

use Bimer\Customer;
use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\PersonCategory;
use Bimer\Test\DataServices\CustomerData;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class PersonCategoryTest extends ResourceTest
{
    protected static ?stdClass $person = null;

    protected string $categoryId = '0000000006';

    /**
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws GuzzleException
     * @throws BimerRequestException
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$person = self::createCustomer();
    }

    public function setUp(): void
    {
        $this->resource = PersonCategory::class;
    }

    public function testBindCategoryToPerson()
    {
        $response = $this->resource::bindCategoryToPerson(
            [
                "Identificador" => self::$person->Identificador,
                "IdentificadorCategoria" => $this->categoryId,
            ]);

        $this->assertObjectHasProperty('Identificador', $response);
    }


    public function testUpdatePersonCategory()
    {
        $response = $this->resource::updatePersonCategory(
            self::$person->Identificador,
            $this->categoryId,
            [
                "IdentificadorPessoaRelacionada" => self::$person->Identificador,
                "Ativo" => true,
                "CodigoChamadaExterno" => '01',
            ]);

        $this->assertObjectHasProperty('Identificador', $response);
    }

    public function testDisablePersonCategory()
    {
        $response = $this->resource::updatePersonCategory(
            self::$person->Identificador,
            $this->categoryId,
            [
                "IdentificadorPessoaRelacionada" => self::$person->Identificador,
                "Ativo" => false,
                "CodigoChamadaExterno" => '01',
            ]);

        $this->assertObjectHasProperty('Identificador', $response);
    }


    /**
     * @return stdClass
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    private static function createCustomer(): stdClass
    {
        return Customer::create(CustomerData::get());
    }

}
