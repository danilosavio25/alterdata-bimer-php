<?php

namespace Bimer\Test\DataServices;

class AddressData
{
    /**
     * Data provider for Address Data
     */
    public static function get(): array
    {
        return (array)json_decode(getenv('DATA_ADDRESS'));
    }

}
