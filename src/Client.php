<?php

namespace TeiaCardSdk;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use TeiaCardSdk\Endpoints\Autenticacao\Autenticacao;
use TeiaCardSdk\Endpoints\Enumerador\Adquirente;
use TeiaCardSdk\Endpoints\Enumerador\Bandeira;
use TeiaCardSdk\Endpoints\Enumerador\CampoDivergente;
use TeiaCardSdk\Endpoints\Enumerador\MotivoEstorno;
use TeiaCardSdk\Endpoints\Enumerador\MotivoStatusConciliacao;
use TeiaCardSdk\Endpoints\Enumerador\TipoAjuste;
use TeiaCardSdk\Endpoints\Enumerador\TipoBaixa;
use TeiaCardSdk\Endpoints\Enumerador\TipoInscricao;
use TeiaCardSdk\Endpoints\Enumerador\TipoMaquineta;
use TeiaCardSdk\Endpoints\Enumerador\TipoServico;
use TeiaCardSdk\Endpoints\Enumerador\Voucher;
use TeiaCardSdk\Endpoints\Remessa\Venda;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use Throwable;

class Client
{
    /** @var string  */
    private const BASE_URI_PROD = 'https://api.saferedi.nteia.com/v1/';

    /** @var string  */
    private const BASE_URI_HMG = 'https://api.sandbox.saferedi.nteia.com/v1/';

    /** @var string */
    private $token;

    /** @var HttpClient */
    private $http;

    /** @var Autenticacao */
    private $autenticacao;

    /** @var Adquirente */
    private $adquirentes;

    /** @var Bandeira */
    private $bandeiras;

    /** @var CampoDivergente */
    private $campoDivergente;

    /** @var MotivoEstorno */
    private $motivoEstorno;

    /** @var MotivoStatusConciliacao */
    private $motivoStatusConciliacao;

    /** @var TipoAjuste */
    private $tipoAjuste;

    /** @var TipoBaixa */
    private $tipoBaixa;

    /** @var TipoInscricao */
    private $tipoInscricao;

    /** @var TipoMaquineta */
    private $tipoMaquineta;

    /** @var TipoServico */
    private $tipoServico;

    /** @var Voucher */
    private $voucher;

    /** @var Venda */
    private $venda;

    public $container;

    public function __construct(string $accessToken = null, float $timeout = 5.0)
    {
//        $options = [
//            'base_uri'        => self::BASE_URI_HMG,
//            'timeout'         => $timeout,
//            'connect_timeout' => $timeout,
//            'handler' => $stack,
//        ];

        if ($accessToken) {
            $this->token = $accessToken;
        }

        $this->container = [];
        $history = Middleware::history($this->container);

        $stack = HandlerStack::create();
        // Add the history middleware to the handler stack.
        $stack->push($history);


        $options = [
            'base_uri'        => self::BASE_URI_HMG,
            'timeout'         => $timeout,
            'connect_timeout' => $timeout,
            'handler' => $stack,
        ];

        $this->http = new HttpClient($options);

        $this->autenticacao            = new Autenticacao($this);
        $this->adquirentes             = new Adquirente($this);
        $this->bandeiras               = new Bandeira($this);
        $this->campoDivergente         = new CampoDivergente($this);
        $this->motivoEstorno           = new MotivoEstorno($this);
        $this->motivoStatusConciliacao = new MotivoStatusConciliacao($this);
        $this->tipoAjuste              = new TipoAjuste($this);
        $this->tipoBaixa               = new TipoBaixa($this);
        $this->tipoInscricao           = new TipoInscricao($this);
        $this->tipoMaquineta           = new TipoMaquineta($this);
        $this->tipoServico             = new TipoServico($this);
        $this->voucher                 = new Voucher($this);
        $this->venda                   = new Venda($this);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     * @throws TeiaCardBaseException
     */
    public function request(string $method, string $uri, array $options = []): array
    {
        try {
            $options = $this->mergeOptions($options);

            $response = $this->http->request(
                $method,
                $uri,
                $options
            );

            foreach ($this->container as $transaction) {
                echo (string) $transaction['request']->getBody();
            }

            $teste = $response->getBody()->getContents();

            echo PHP_EOL . PHP_EOL . $teste . PHP_EOL . PHP_EOL;

//            die('FIM');

            return ResponseHandler::success($teste);
//            return ResponseHandler::success($response->getBody()->getContents());
//        } catch (Throwable $exception) {
        } catch (Throwable $exception) {
//            foreach ($this->container as $transaction) {
////                echo $transaction['request']->getMethod();
//                echo (string) $transaction['request']->getBody();
//            }

//            $teste = $exception->getResponse()->getBody()->getContents();

//            echo PHP_EOL . PHP_EOL . 'TESTE - ' . $teste . PHP_EOL . PHP_EOL;


//            die($exception->getTraceAsString());
//            die($exception->getMessage());
            throw ResponseHandler::failure($exception);
//        } catch (Throwable $e) {
//            die("\ndeu merda grande... - {$e->getMessage()} \n\n");
        }
    }

    /**
     * @param array $options
     * @return array
     */
    private function mergeOptions(array $options = []): array
    {
        $baseOptions = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ];

        // TODO: Colocar em uma condição
        $options['debug'] = true;

        if ($this->token) {
            $baseOptions['headers']['Authorization'] = 'Bearer ' . $this->token;
        }

        return array_merge($baseOptions, $options);
    }

    public function setToken(string $token): Client
    {
        $this->token = $token;
        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return Autenticacao
     */
    public function autenticacao(): Autenticacao
    {
        return $this->autenticacao;
    }

    /**
     * @return Adquirente
     */
    public function adquirentes(): Adquirente
    {
        return $this->adquirentes;
    }

    /**
     * @return Bandeira
     */
    public function bandeiras(): Bandeira
    {
        return $this->bandeiras;
    }

    /**
     * @return CampoDivergente
     */
    public function campoDivergente(): CampoDivergente
    {
        return $this->campoDivergente;
    }

    /**
     * @return MotivoEstorno
     */
    public function motivoEstorno(): MotivoEstorno
    {
        return $this->motivoEstorno;
    }

    /**
     * @return MotivoStatusConciliacao
     */
    public function motivoStatusConciliacao(): MotivoStatusConciliacao
    {
        return $this->motivoStatusConciliacao;
    }

    /**
     * @return TipoAjuste
     */
    public function tipoAjuste(): TipoAjuste
    {
        return $this->tipoAjuste;
    }

    /**
     * @return TipoBaixa
     */
    public function tipoBaixa(): TipoBaixa
    {
        return $this->tipoBaixa;
    }

    /**
     * @return TipoInscricao
     */
    public function tipoInscricao(): TipoInscricao
    {
        return $this->tipoInscricao;
    }

    /**
     * @return TipoMaquineta
     */
    public function tipoMaquineta(): TipoMaquineta
    {
        return $this->tipoMaquineta;
    }

    /**
     * @return TipoServico
     */
    public function tipoServico(): TipoServico
    {
        return $this->tipoServico;
    }

    /**
     * @return Voucher
     */
    public function voucher(): Voucher
    {
        return $this->voucher;
    }

    /**
     * @return Venda
     */
    public function vendas(): Venda
    {
        return $this->venda;
    }
}
