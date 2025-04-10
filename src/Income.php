<?php

namespace Bimer;

use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\Http\Resource;
use GuzzleHttp\Exception\GuzzleException;

class Income extends Resource
{
    /**
     * @return string
     */
    public static function endpoint(): string
    {
        return 'titulosAReceber';
    }

    /**
     * @param array $params
     * @return mixed
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function makeBatch(array $params): mixed
    {
        return static::create($params, "lote/baixas");
    }
}
