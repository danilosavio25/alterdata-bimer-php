<?php

namespace Bimer\Test\DataServices;

class IncomeData
{
    /**
     * Data provider for Income Data
     */
    public static function get(): array
    {
        return array_merge((array)json_decode(getenv('DATA_INCOME')), [
            "NumeroTitulo" => random_int(10000, 999999),
            "ValorTitulo" => 100
        ]);
    }
}
