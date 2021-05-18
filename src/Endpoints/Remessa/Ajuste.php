<?php

namespace TeiaCardSdk\Endpoints\Remessa;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use TeiaCardSdk\Data\Requests\Venda\Wrapper;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;

class Ajuste extends Endpoint
{
    /**
     * @param  Wrapper  $empresas
     *
     * @return Collection
     * @throws TeiaCardBaseException
     */
    public function send(Wrapper $empresas): Collection
    {
        $response = $this->client->request(
            self::POST,
            Routes::ajusts()->send(),
            [RequestOptions::BODY => $empresas->toJson()]
        );


        return collect($response);
    }
}
