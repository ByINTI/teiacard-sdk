<?php

namespace TeiaCardSdk\Endpoints\Enumerador;

use Illuminate\Support\Collection;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;
use Throwable;

class TipoInscricao extends Endpoint
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
            Routes::tipoInscricao()->list()
        );

        return collect($response['data']);
    }
}
