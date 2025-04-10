<?php
declare(strict_types=1);

namespace Bimer\Test;

use Bimer\Customer;
use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\Person;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class PersonTest extends ResourceTest
{
    public function setUp(): void
    {
        $this->resource = Person::class;

        $this->incomeData = (array)json_decode(getenv('DATA_PERSON'));
    }

    public function testValidateName()
    {
        $this->expectException(BimerApiException::class);

        $this->resource::getByName('a');
    }

    public function testGetByName()
    {
        $response = $this->resource::getByName('NOME');

        $this->assertIsArray($response);
        $this->assertGreaterThanOrEqual(0, count($response));
    }

    public function testValidateCpfCnpj()
    {
        $this->expectException(BimerApiException::class);

        $this->resource::getByCpfCnpj('123.456.789-01');
    }

    /**
     * @dataProvider addressData
     */
    public function testCreatePerson(array $addressData)
    {
        $customer = $this->createCustomer($addressData);

        $this->assertObjectHasAttribute('Identificador', $customer);
    }

    public function testGetEmptyCpfCnpjShouldReturnNotFoundException()
    {
        $randomCpf = GeneratorHelper::cpfRandom(false);
        $this->expectException(BimerApiException::class);
        $this->resource::getByCpfCnpj($randomCpf);
    }

    public function testGetSomeCpfCnpj()
    {
        $response = $this->resource::getByCpfCnpj($this->incomeData['cpfCnpj']);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /**
     * @dataProvider addressData
     */
    public function testGetById(array $addressData)
    {
        $customer = $this->createCustomer($addressData);
        $person = $this->resource::find($customer->Identificador);
        $this->assertObjectHasAttribute('Identificador', $person);
    }

    /**
     * @dataProvider addressData
     */
    public function testChangePersonData(array $addressData)
    {
        $customer = $this->createCustomer($addressData);

        $placeholder = 'CHANGE TEST';
        $data = [
            'Nome' => $placeholder,
            'Enderecos' => [
                array_merge($addressData, [
                    'Codigo' => '01',
                    'TipoCadastro' => 'A',
                    'NomeLogradouro' => $placeholder,
                    'Tipos' => [
                        'Principal' => true
                    ],
                    //'IdentificadorCidade' => '00A0000001',
                ])
            ]
        ];

        $person = $this->resource::update($customer->Identificador, $data);

        $this->assertSame($person->Nome, $placeholder);
        $this->assertSame($person->Enderecos[0]->NomeLogradouro, $placeholder);
    }

    /**
     * Data provider for Address Data
     */
    public function addressData(): array
    {
        $address = (array) json_decode(getenv('DATA_ADDRESS'));

        return [
            [
                $address
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
    private function createCustomer(array $addressData): stdClass
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
                    ],
                    'IdentificadorCidade' => '00A0000001',
                ])
            ]
        ]);
    }
}
