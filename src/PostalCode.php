<?php

namespace Bimer;

use Bimer\Exceptions\BimerApiException;
use Bimer\Exceptions\BimerParameterException;
use Bimer\Exceptions\BimerRequestException;
use Bimer\Helpers\Sanitizer;
use Bimer\Helpers\Validator;
use Bimer\Http\Resource;
use GuzzleHttp\Exception\GuzzleException;

class PostalCode extends Resource
{
    /**
     * @return string
     */
    public static function endpoint(): string
    {
        return 'ceps';
    }

    /**
     * @param $code
     * @param bool $validate
     * @return mixed
     * @throws BimerApiException
     * @throws BimerRequestException
     * @throws BimerParameterException
     * @throws GuzzleException
     */
    public static function getByCode($code, bool $validate = true): mixed
    {
        if ($validate && !Validator::validatePostalCode($code)) {
            throw new BimerApiException('The parameter "code" must be valid');
        }

        $code = Sanitizer::formatPostalCode($code);

        return static::get("codigo/$code");
    }
}
