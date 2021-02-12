<?php

namespace TeiaCardSdk\Endpoints\Autenticacao;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use JsonException;
use TeiaCardSdk\Data\Requests\Autenticacao\Credenciais;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;
use Throwable;

/**
 * Class Authentication
 * @package TeiaCardSdk
 */
class Autenticacao extends Endpoint
{
    /**
     * @param Credenciais $payload
     * @return Collection
     * @throws TeiaCardBaseException
     */
    public function login(Credenciais $payload): Collection
    {
        $response = $this->client->request(
            self::POST,
            Routes::authentication()->login(),
            [RequestOptions::BODY => $payload->toJson()]
        );

        $collection = collect($response);

        $this->client->setToken($collection->get('access_token'));

        return $collection;
    }
}
