<?php

namespace TeiaCardSdk\Endpoints\Retorno;

use Illuminate\Support\Collection;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;
use Throwable;

class Loja extends Endpoint
{
    /**
     * @return Collection
     * @throws Throwable
     * @throws TeiaCardBaseException
     */
    public function getList(string $companyCode): Collection
    {
        $response = $this->client->request(
            self::GET,
            Routes::stores($companyCode)->list()
        );

        return collect($response['data']);
    }
}
