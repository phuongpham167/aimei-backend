<?php

namespace App\Http\Responses;

use Exception;
use App\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\ResponseBuilder;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ErrorResponseBuilder extends ResponseBuilder
{
    protected $additional = [];

    protected $code;

    protected $message;

    public function __construct($code, $message = '', $status = 500, $additional = [], $headers = [])
    {
        $this->code = $code;
        $this->message = $message;
        $this->status = $status;
        $this->additional = $additional;
        $this->headers = $headers;
    }

    public static function make($code, $message = '', $status = 500, $additional = [], $headers = [])
    {
        return new static($code, $message, $status, $additional, $headers);
    }

    public static function unauthorized($message = 'Unauthorized', $code = 'unauthorized')
    {
        return static::make($code, $message, Response::HTTP_UNAUTHORIZED);
    }

    public static function debug(Exception $e)
    {
        $debug = [
            'exception' => get_class($e),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => collect($e->getTrace())->map(function ($trace) {
                return Arr::except($trace, ['args']);
            })->all()
        ];

        return static::make(
            static::getCodeFromException($e),
            static::getMessageFromException($e),
            static::getHttpStatus($e),
            $debug
        );
    }

    public static function validation(ValidationException $e)
    {
        $extra = ['fields' => $e->validator->errors()];

        return static::make(
            'validation_failed',
            $e->getMessage(),
            Response::HTTP_UNPROCESSABLE_ENTITY,
            $extra
        );
    }

    public static function forbidden($message = 'Forbidden', $code = 'forbidden')
    {
        return static::make($code, $message, 403);
    }

    public static function exception(Exception $e)
    {
        if (config('app.debug')) {
            return static::debug($e);
        }

        /** @var Exception | HttpExceptionInterface $e */
        return static::make(
            static::getCodeFromException($e),
            static::getMessageFromException($e),
            static::getHttpStatus($e)
        )
            ->headers(static::isHttpException($e) ? $e->getHeaders() : []);
    }

    protected static function getHttpStatus(Exception $e)
    {
        /** @var Exception | HttpExceptionInterface $e */
        return static::isHttpException($e) ? $e->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    protected static function getMessageFromException(Exception $e)
    {
        // Convert message from code for case message is empty
        return $e->getMessage() ?: ucfirst(str_replace('_', ' ', $code = static::getCodeFromException($e)));
    }

    protected static function isHttpException(Exception $e)
    {
        return $e instanceof HttpExceptionInterface;
    }

    protected static function getCodeFromException(Exception $e)
    {
        $code = $e->getCode();

        if ($code) {
            return $code;
        }

        if (static::isHttpException($e)) {
            /** @var HttpExceptionInterface $e */
            return Str::snake(Response::$statusTexts[$e->getStatusCode()]);
        }

        $code = str_replace(['Http', 'Exception'], '', class_basename($e)) ?: 'Unknown';

        return Str::snake($code);
    }

    public function toArray()
    {
        $error = array_merge($this->additional, [
            'message' => $this->message,
            'code' => $this->code,
            'status' => $this->status,
        ]);

        return [
            'error' => $error
        ];
    }

    /**
     * @param array $additional
     * @return ErrorResponseBuilder
     */
    public function additional($additional = [])
    {
        $this->additional = $additional;

        return $this;
    }

    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    public function code($code)
    {
        $this->code = $code;

        return $this;
    }
}
