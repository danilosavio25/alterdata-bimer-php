<?php

namespace Bimer;

use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\Http\Resource;
use GuzzleHttp\Exception\GuzzleException;

class PersonRelationship extends Resource
{

    /**
     * @return string
     */
    public static function endpoint(): string
    {
        return 'pessoas';
    }

    public static function customEndpoint(string $id): string
    {
        return "$id/relacionamentos";
    }

    /**
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function getByPersonId(string $id)
    {
        return static::get(self::customEndpoint($id));
    }


    /**
     * @param string $personId
     * @param array $params
     * @return array
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function createRelationship(string $personId, array $params): array
    {
        return parent::create($params, self::customEndpoint($personId));
    }

    /**
     * @param string $id
     * @param array $params
     * @return array
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function delete(string $id, array $params = []): array
    {
        return parent::delete(self::customEndpoint($id), $params);
    }

}
