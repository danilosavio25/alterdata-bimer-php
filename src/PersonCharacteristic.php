<?php

namespace Bimer;

use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\Http\Resource;
use GuzzleHttp\Exception\GuzzleException;

class PersonCharacteristic extends Resource
{
    /**
     * @return string
     */
    public static function endpoint(): string
    {
        return 'pessoa/caracteristicas';
    }

    public static function customEndpoint(string $personId, string $characteristicId): string
    {
        return "pessoa/$personId/caracteristica/$characteristicId";
    }



    /**
     * @param string $personId
     * @param string $characteristicId
     * @param array $params
     * @return mixed
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function unbindPersonCharacteristic(string $personId, string $characteristicId, array $params = []): mixed
    {
        return parent::delete(self::customEndpoint($personId, $characteristicId), $params);
    }
}
