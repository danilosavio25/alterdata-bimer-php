<?php

namespace Bimer\Test\DataServices;

class CharacteristicData
{
    /**
     * Data provider for Account Data
     */
    public static function get(): array
    {
        return (array)json_decode(getenv('DATA_CHARACTERISTIC'));
    }
}
