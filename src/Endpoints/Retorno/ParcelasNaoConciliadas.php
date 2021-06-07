<?php

namespace TeiaCardSdk\Endpoints\Retorno;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use TeiaCardSdk\Data\Requests\Parcela\ParcelaNaoConciliada;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;

class ParcelasNaoConciliadas extends Endpoint
{
    /**
     * @var ParcelaNaoConciliada
     */
    private $parcelaNaoConciliada;

    /**
     * @return ParcelaNaoConciliada
     */
    public function getParcelaNaoConciliada(): ParcelaNaoConciliada
    {
        return $this->parcelaNaoConciliada;
    }

    /**
     * @param  ParcelaNaoConciliada  $parcelaNaoConciliada
     */
    public function setParcelaNaoConciliada(ParcelaNaoConciliada $parcelaNaoConciliada): void
    {
        $this->parcelaNaoConciliada = $parcelaNaoConciliada;
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
            Routes::unreconciledInstallments()->list(),
            [RequestOptions::QUERY => $this->getParcelaNaoConciliada()->toArray()]
        );


        return collect($response);
    }
}
