<?php

namespace TeiaCardSdk\Endpoints\Remessa;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use TeiaCardSdk\Data\Requests\Venda\Wrapper;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;

class Venda extends Endpoint
{
    /**
     * @param  int  $id
     *
     * @return Collection
     * @throws TeiaCardBaseException
     */
    public function status(int $id): Collection
    {
        $a = $this->client->request(
            self::GET,
            Routes::sales()->status($id)
        );

        return collect($a);
    }

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
            Routes::sales()->send(),
            [RequestOptions::BODY => $empresas->toJson()]
        );

        return collect($response);
    }
}
