<?php

namespace TeiaCardSdk\Endpoints\Remessa;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use TeiaCardSdk\Data\Contracts\DataInterface;
use TeiaCardSdk\Data\Requests\Venda\Empresa;
use TeiaCardSdk\Data\Requests\Venda\Wrapper;
use TeiaCardSdk\Endpoints\Endpoint;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use TeiaCardSdk\Routes;
use Throwable;

class Venda extends Endpoint
{
    /**
     * @return DataInterface
     * @throws Throwable
     */
//    public function send(): DataInterface
//    {
//        $response = $this->client->request(
//            self::POST,
//            Routes::sales()->send()
//        );
//
//        return AcquirerResponse::createFromArray($response);
//    }

    /**
     * @param int $id
     * @return Collection
     * @throws TeiaCardBaseException
     */
    public function status(int $id): Collection
    {
        $a = $this->client->request(
            self::GET,
            Routes::sales()->status($id)
        );

        print_r($a);
        print_r("\nUOUFILHOTE\n");
        die;

        return $a;
    }

    /**
     * @param Wrapper $empresas
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
//        print_r('AQUI PORRA: ', $t);
//        die;
    }
}
