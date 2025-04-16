<?php

namespace Bimer\Test\DataServices;

class BatchData
{
    /**
     * Data provider for Batch Data
     */
    public static function get(): array
    {
        return (array)json_decode(getenv('DATA_INCOME_BATCH'));
    }
}
