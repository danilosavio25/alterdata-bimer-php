<?php
declare(strict_types=1);

namespace Bimer\Test;

use Bimer\Customer;
use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\PersonCategory;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class PersonCategoryTest extends ResourceTest
{

    protected static ?stdClass $person = null;

    protected string $categoryId = '0000000006';

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$person = self::createCustomer(self::addressData());
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

        $this->assertObjectHasAttribute('Identificador', $response);
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

        $this->assertObjectHasAttribute('Identificador', $response);
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

        $this->assertObjectHasAttribute('Identificador', $response);
    }

    /**
     * Data provider for Address Data
     */
    private static function addressData(): array
    {
        $areaType = (array)json_decode(getenv('DATA_ADDRESS'));

        return [
            [
                $areaType
            ]
        ];
    }

    /**
     * @return stdClass
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    private static function createCustomer(array $addressData): \stdClass
    {
        return Customer::create([
            'Nome' => 'Customer #' . rand(),
            'CpfCnpj' => GeneratorHelper::cpfRandom(false),
            'Enderecos' => [
                array_merge($addressData, [
                    'Codigo' => '01',
                    'TipoCadastro' => 'I',
                    'NomeLogradouro' => 'CREATE TEST',
                    'Tipos' => [
                        'Principal' => true
                    ]
                ])
            ]
        ]);
    }

}
