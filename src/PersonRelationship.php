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
    public static function getByPersonId(string $id): mixed
    {
        return static::all([], self::customEndpoint($id));
    }


    /**
     * @param string $personId
     * @param array $params
     * @return mixed
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function createRelationship(string $personId, array $params): mixed
    {
        return parent::create($params, self::customEndpoint($personId));
    }

    /**
     * @param string $id
     * @param array $params
     * @return mixed
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function deleteRelationship(string $id, array $params = []): mixed
    {
        return parent::delete(self::customEndpoint($id), $params);
    }

}
