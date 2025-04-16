<?php

namespace Bimer\Test\DataServices;

class AreaTypeData
{
    /**
     * Data provider for Area Type Data
     */
    public static function get(): array
    {
        return (array)json_decode(getenv('DATA_AREA_TYPE'));
    }
}
