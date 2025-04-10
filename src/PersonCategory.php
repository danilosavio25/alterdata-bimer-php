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
     * @return mixed
     * @throws BimerApiException
     * @throws BimerParameterException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function bindCategoryToPerson(array $params): mixed
    {
        return parent::create($params, 'vincularCategoria');
    }

    /**
     * @throws BimerParameterException
     * @throws BimerApiException
     * @throws BimerRequestException
     * @throws GuzzleException
     */
    public static function updatePersonCategory(string $personId, string $categoryId, array $params): mixed
    {
        return parent::update(self::customEndpoint($personId, $categoryId), $params);
    }

}
