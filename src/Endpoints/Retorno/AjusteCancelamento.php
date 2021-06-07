<?php

namespace TeiaCardSdk\Endpoints\Retorno;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use TeiaCardSdk\Data\Requests\AjusteCancelamento\Ajuste;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;

class AjusteCancelamento extends Endpoint
{
    /**
     * @var Ajuste
     */
    private $ajuste;

    /**
     * @return Ajuste
     */
    public function getAjuste(): Ajuste
    {
        return $this->ajuste;
    }

    /**
     * @param  Ajuste  $ajuste
     */
    public function setAjuste(Ajuste $ajuste): void
    {
        $this->ajuste = $ajuste;
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
            Routes::cancellationAdjustment()->list(),
            [RequestOptions::QUERY => $this->getAjuste()->toArray()]
        );


        return collect($response);
    }
}
