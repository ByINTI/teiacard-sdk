<?php

namespace TeiaCardSdk;

use Exception;
use GuzzleHttp\Exception\RequestException;
use JsonException;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Exceptions\TeiaCardHttpException;
use Throwable;

class ResponseHandler
{
    /**
     * @param  string  $payload
     *
     * @return array
     * @throws JsonException
     */
    public static function success(string $payload): array
    {
        return json_decode($payload, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param  Throwable  $e
     *
     * @return TeiaCardBaseException
     */
    public static function failure(Throwable $e): Exception
    {
        if (!$e instanceof RequestException) {
            return new TeiaCardBaseException('Fatal Error - 1', $e->getMessage(), $e->getCode(), $e);
        }

        $response = $e->getResponse();

        if (is_null($response)) {
            return new TeiaCardBaseException('Fatal Error - 2', $e->getMessage(), $e->getCode(), $e);
        }

        $errorData = $response->getBody()->getContents();

        try {
            $errorArray = json_decode($errorData, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return new TeiaCardHttpException('Invalid JSON Error', $e->getMessage(), $e->getCode(), $e);
        }

        return new TeiaCardHttpException(
            $errorArray['error'] ?? $errorArray['status'] ?? 'Fatal Error - 3',
            $errorArray['message'] ?? $e->getMessage(),
            $errorArray['status_code'] ?? $e->getCode(),
            $e->getPrevious()
        );
    }
}
