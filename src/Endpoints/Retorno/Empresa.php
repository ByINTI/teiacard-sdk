<?php

namespace TeiaCardSdk\Endpoints\Retorno;

use Illuminate\Support\Collection;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;
use Throwable;

class Empresa extends Endpoint
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
            Routes::empresa()->list()
        );

        return collect($response['data']);
    }
}
