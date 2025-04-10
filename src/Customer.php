<?php

namespace Bimer;

use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\Http\Resource;
use GuzzleHttp\Exception\GuzzleException;

class Customer extends Resource
{
    /**
     * @return string
     */
    public static function endpoint(): string
    {
        return 'clientes';
    }

    /**
     * @param array $params
     * @param string $endpoint
     * @return mixed
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function create(array $params, string $endpoint = ''): mixed
    {
        // NOTE: Bimer API makes no parameters validation
        // In case of invalid data, the HTTP will fail with 500 error code
        if (!isset($params['Nome'])) {
            throw new BimerApiException('The parameter "Nome" is mandatory');
        }

        return parent::create($params);
    }
}
