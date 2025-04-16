<?php

namespace Bimer\Test\DataServices;

class AccountData
{
    /**
     * Data provider for Account Data
     */
    public static function get(): array
    {
        return (array)json_decode(getenv('DATA_ACCOUNT'));
    }
}
