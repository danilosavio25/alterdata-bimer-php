<?php

namespace Bimer;

use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\Http\Resource;
use GuzzleHttp\Exception\GuzzleException;

class PersonCategory extends Resource
{

    /**
     * @return string
     */
    public static function endpoint(): string
    {
        return 'pessoas';
    }

    public static function customEndpoint(string $personId, string $categoryId): string
    {
        return "$personId/categorias/$categoryId";
    }

    /**
     * @param array $params
     * @param string $endpoint
     * @return array
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function create(array $params, string $endpoint = ''): array
    {
        return parent::create($params, '/vincularCategoria');
    }

    /**
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function updateCategory(string $personId, string $categoryId, array $params)
    {
        return parent::update(self::customEndpoint($personId, $categoryId), $params);
    }

    /**
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws GuzzleException
     * @throws BimerRequestException
     */
    public static function enableOrDisable(string $personId, string $categoryId, array $params)
    {
        return parent::patch($params, self::customEndpoint($personId, $categoryId));
    }

}
