<?php

namespace App\Http;

use App\Http\Responses\ErrorResponseBuilder;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class Response extends JsonResponse
{
    public static function exception(Exception $e)
    {
        return ErrorResponseBuilder::exception($e)->toResponse(static::resolveRequest());
    }

    public static function validation(ValidationException $e)
    {
        return ErrorResponseBuilder::validation($e)->toResponse(static::resolveRequest());
    }

    public static function forbidden($code = 'forbidden', $message = 'Forbidden')
    {
        return ErrorResponseBuilder::forbidden($message, $code)->toResponse(static::resolveRequest());
    }

    public static function unauthorized($message = 'Unauthorized', $code = 'unauthorized')
    {
        return ErrorResponseBuilder::unauthorized($message, $code)->toResponse(static::resolveRequest());
    }

    public static function notFound($message = "Resource not found")
    {
        return ErrorResponseBuilder::make('not_found', $message, 404);
    }

    public static function error($code, $message = 'Unknown error', $status = 500, $additional = [], $headers = [])
    {
        return ErrorResponseBuilder::make($code, $message, $status, $additional, $headers)->toResponse(self::resolveRequest());
    }

    public static function badRequest($code = 'bad_request', $message = 'Bad request')
    {
        return ErrorResponseBuilder::make($code, $message, 400)->toResponse(static::resolveRequest());
    }
    public static function resolveRequest()
    {
        return request();
    }
}
