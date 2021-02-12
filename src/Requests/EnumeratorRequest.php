<?php

namespace TeiaCardSdk\Requests;

use GuzzleHttp\Psr7\Request;
use TeiaCardSdk\Data\Contracts\DataInterface;
use TeiaCardSdk\Data\Requests\AuthCredentials;
use TeiaCardSdk\Data\Responses\AuthLoginResponse;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Exceptions\TeiaCardSdkClientException;

class EnumeratorRequest extends BaseRequest
{
    /** @var AuthCredentials */
    private $credentials;

    /**
     * AuthenticationRequest constructor.
     *
     * @param AuthCredentials $credentials
     * @param bool $debug
     */
    public function __construct(AuthCredentials $credentials, bool $debug = false)
    {
        parent::__construct($debug);

        $this->credentials = $credentials;
    }

    /**
     * Overriden to alter return tag for ID autocompletion
     * because PHP < 7.4 doesn't allow overriding return type
     * of a class implementing the interface.
     *
     * Should be removed when migrating to PHP >= 7.4
     *
     * @return AuthLoginResponse
     * @throws TeiaCardBaseException|TeiaCardSdkClientException
     */
    public function execute(): DataInterface
    {
        return parent::execute();
    }

    /**
     * @return Request
     */
    protected function makeRequest(): Request
    {
        return new Request('GET', 'enum/adquirente', ['Authorization' => 'Bearer XYZ'], '');
    }

    /**
     * @param array $response
     * @return AuthLoginResponse
     */
    protected function processResponse(array $response): DataInterface
    {
        $authLoginResponse = new AuthLoginResponse();

        $authLoginResponse->setAccessToken($response['access_token'])
                          ->setTokenType($response['token_type'])
                          ->setExpiresIn($response['expires_in'])
                          ->setRefreshToken($response['refresh_token']);

        return $authLoginResponse;
    }
}
