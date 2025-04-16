<?php

namespace Bimer\Test\DataServices;

class PersonData
{
    /**
     * Data provider for Person Data
     */
    public static function get(): array
    {
        return (array)json_decode(getenv('DATA_PERSON'));
    }
}
