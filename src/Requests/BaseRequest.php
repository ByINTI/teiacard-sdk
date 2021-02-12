<?php

namespace TeiaCardSdk\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use JsonException;
use Psr\Http\Message\StreamInterface;
use TeiaCardSdk\Data\Contracts\DataInterface;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Exceptions\TeiaCardSdkClientException;
use Throwable;

/**
 * Class BaseRequest
 * @package TeiaCardSdk\Request
 */
abstract class BaseRequest
{
    /** @var Client $client */
    protected $client;
    /** @var bool */
    protected $debug = false;
    /** @var string[] */
    private $baseUri = [
        'homologation' => 'https://api.sandbox.saferedi.nteia.com/v1/',
        'production'   => 'https://api.amedigital.com/api/',
    ];

    /**
     * BaseRequest constructor.
     * @param bool $debug
     */
    public function __construct(bool $debug = false)
    {
        $this->client = new Client([
            'base_uri' => $debug ? $this->baseUri['production'] : $this->baseUri['homologation'],
            'headers'  => [
                'User-Agent'      => 'ByINTI/1.0',
                'Accept'          => 'application/json',
                'Content-Type'    => 'application/json',
                'Accept-Encoding' => 'gzip, deflate',
            ],
        ]);
    }

    /**
     * Activates Guzzle debug for the current request
     *
     * @return $this
     */
    public function withDebug(): self
    {
        $this->debug = true;
        return $this;
    }

    /**
     * @return DataInterface
     */
    public function execute(): DataInterface
    {
        try {
            $response = $this->client->send($this->makeRequest(), ['debug' => $this->debug]);

            $responseArray = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

            return $this->processResponse($responseArray);
        } catch (GuzzleException $e) {
            if ($error = $e->getResponse()) {
//            if ($error = null) {
                $errorArr = json_decode($error->getBody(), true, 512, JSON_THROW_ON_ERROR);

                throw new TeiaCardSdkClientException(
                    $errorArr['error'] ?? 'Client Error',
                    $errorArr['message'] ?? 'An unexpected error ocurred.',
                    $error->getStatusCode() ?? 500,
                    $e->getPrevious()
                );
            }

            throw new TeiaCardBaseException(
                'Request Error',
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
        }
    }

    /**
     * @return Request
     */
    abstract protected function makeRequest(): Request;

    /**
     * @param array $response
     * @return DataInterface
     */
    abstract protected function processResponse(array $response): DataInterface;
}
