<?php
declare(strict_types=1);

namespace Bimer\Test;

use Bimer\Customer;
use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\Person;
use Bimer\Test\DataServices\AddressData;
use Bimer\Test\DataServices\PersonData;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class PersonTest extends ResourceTest
{
    public function setUp(): void
    {
        $this->resource = Person::class;
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
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws GuzzleException
     * @throws BimerRequestException
     */
    public function testCreatePerson()
    {
        $customer = $this->createCustomer();

        $this->assertObjectHasProperty('Identificador', $customer);
    }

    public function testGetEmptyCpfCnpjShouldReturnNotFoundException()
    {
        $randomCpf = GeneratorHelper::cpfRandom(false);

        $this->expectException(BimerApiException::class);

        $this->resource::getByCpfCnpj($randomCpf);
    }

    public function testGetSomeCpfCnpj()
    {
        $personData = PersonData::get();

        $response = $this->resource::getByCpfCnpj($personData['cpfCnpj']);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }


    /**
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws GuzzleException
     * @throws BimerRequestException
     */
    public function testGetById()
    {
        $customer = $this->createCustomer();
        $person = $this->resource::find($customer->Identificador);
        $this->assertObjectHasProperty('Identificador', $person);
    }

    /**
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws GuzzleException
     * @throws BimerRequestException
     */
    public function testChangePersonData()
    {
        $customer = $this->createCustomer();

        $addressData = AddressData::get();

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
                ])
            ]
        ];

        $person = $this->resource::update($customer->Identificador, $data);

        $this->assertSame($person->Nome, $placeholder);
        $this->assertSame($person->Enderecos[0]->NomeLogradouro, $placeholder);
    }

    /**
     * @return stdClass
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    private function createCustomer(): stdClass
    {
        $addressData = AddressData::get();

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
