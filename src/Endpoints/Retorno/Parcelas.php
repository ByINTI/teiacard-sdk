<?php

namespace TeiaCardSdk\Endpoints\Retorno;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use TeiaCardSdk\Data\Requests\Parcela\Parcela;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;

class Parcelas extends Endpoint
{
    /**
     * @var Parcela
     */
    private $parcela;

    /**
     * @return Parcela
     */
    public function getParcela(): Parcela
    {
        return $this->parcela;
    }

    /**
     * @param  Parcela  $parcela
     */
    public function setParcela(Parcela $parcela): void
    {
        $this->parcela = $parcela;
    }

    /**
     *
     * @return Collection
     * @throws TeiaCardBaseException
     */
    public function list(): Collection
    {

        $response = $this->client->request(
            self::GET,
            Routes::installments()->list(),
            [RequestOptions::QUERY => $this->getParcela()->toArray()]
        );


        return collect($response);
    }
}
