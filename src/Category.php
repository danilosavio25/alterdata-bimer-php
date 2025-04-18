<?php

namespace Bimer;

use Bimer\Http\Resource;

class Category extends Resource
{
    /**
     * @return string
     */
    public static function endpoint(): string
    {
        return 'categorias';
    }
}
