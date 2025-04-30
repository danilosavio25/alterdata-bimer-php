<?php

namespace Bimer\Test\DataServices;

use Bimer\Test\GeneratorHelper;

class CustomerData
{
    /**
     * Data provider for Person Data
     */
    public static function get(): array
    {
        $addressData = AddressData::get();
        
        return [
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
        ];
    }
}
