<?php

namespace TeiaCardSdk\Endpoints\Retorno;

use Illuminate\Support\Collection;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;
use Throwable;

class Estabelecimento extends Endpoint
{
    /**
     * @return Collection
     * @throws Throwable
     * @throws TeiaCardBaseException
     */
    public function getList(): Collection
    {
        $response = $this->client->request(
            self::GET,
            Routes::establishments()->list()
        );

        return collect($response['lojas']);
    }
}
