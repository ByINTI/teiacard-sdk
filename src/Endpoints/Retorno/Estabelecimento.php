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
     * @param Collection $lojas
     * @return Collection
     */
    public function getList(Collection $lojas): Collection
    {
        $lojas = $lojas->all();
        return collect(array_reduce($lojas, function ($carry, $loja) {
            foreach ($loja['adquirentes'] as $adquirente) {
                foreach ($adquirente['estabelecimentos'] as $estabelecimento) {
                    $carry[] = $estabelecimento['numero'];
                }
            }
            return $carry;
        }, []) ?? [])
            ->unique()
            ->values();
    }
}
