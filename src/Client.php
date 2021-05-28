<?php

namespace TeiaCardSdk;

use GuzzleHttp\Client as HttpClient;
use TeiaCardSdk\Endpoints\Autenticacao\Autenticacao;
use TeiaCardSdk\Endpoints\Enumerador\Adquirente;
use TeiaCardSdk\Endpoints\Enumerador\Bandeira;
use TeiaCardSdk\Endpoints\Enumerador\CampoDivergente;
use TeiaCardSdk\Endpoints\Enumerador\MeioCaptura;
use TeiaCardSdk\Endpoints\Enumerador\MotivoEstorno;
use TeiaCardSdk\Endpoints\Enumerador\MotivoStatusConciliacao;
use TeiaCardSdk\Endpoints\Enumerador\TipoAjuste;
use TeiaCardSdk\Endpoints\Enumerador\TipoBaixa;
use TeiaCardSdk\Endpoints\Enumerador\TipoInscricao;
use TeiaCardSdk\Endpoints\Enumerador\TipoMaquineta;
use TeiaCardSdk\Endpoints\Enumerador\TipoServico;
use TeiaCardSdk\Endpoints\Enumerador\Voucher;
use TeiaCardSdk\Endpoints\Remessa\Ajuste;
use TeiaCardSdk\Endpoints\Remessa\Venda;
use TeiaCardSdk\Endpoints\Retorno\Empresa;
use TeiaCardSdk\Endpoints\Retorno\Estabelecimento;
use TeiaCardSdk\Endpoints\Retorno\Loja;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;
use Throwable;

class Client
{
    /** @var string */
    private const BASE_URI_PROD = 'https://api.saferedi.nteia.com/v1/';
    /** @var string */
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

    /** @var MeioCaptura */
    private $meioCaptura;

    /** @var Empresa */
    private $empresa;

    /** @var Venda */
    private $venda;

    /** @var Ajuste */
    private $ajuste;

    /** @var Estabelecimento */
    private $estabelecimento;

    /** @var Loja */
    private $loja;

    public function __construct(bool $production = false, string $accessToken = null, float $timeout = 5.0)
    {
        if ($accessToken) {
            $this->token = $accessToken;
        }
        $options = [
            'base_uri'        => self::getUrlByEnv($production),
            'timeout'         => $timeout,
            'connect_timeout' => $timeout,
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
        $this->meioCaptura             = new MeioCaptura($this);
        $this->empresa                 = new Empresa($this);
        $this->venda                   = new Venda($this);
        $this->ajuste                  = new Ajuste($this);
        $this->estabelecimento         = new Estabelecimento($this);
        $this->loja                    = new Loja($this);
    }

    /**
     * @param  string  $method
     * @param  string  $uri
     * @param  array   $options
     *
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

            return ResponseHandler::success($response->getBody()->getContents());
        } catch (Throwable $exception) {
            throw ResponseHandler::failure($exception);
        }
    }

    /**
     * @param  array  $options
     *
     * @return array
     */
    private function mergeOptions(array $options = []): array
    {
        $baseOptions = [
            'headers' => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ];

        if ($this->token) {
            $baseOptions['headers']['Authorization'] = 'Bearer ' . $this->token;
        }

        return array_merge($baseOptions, $options);
    }

    private static function getUrlByEnv(bool $production): string
    {
        return $production ? self::BASE_URI_PROD : self::BASE_URI_HMG;
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
     * @return MeioCaptura
     */
    public function meioCaptura(): MeioCaptura
    {
        return $this->meioCaptura;
    }

    /**
     * @return Empresa
     */
    public function empresa(): Empresa
    {
        return $this->empresa;
    }

    /**
     * @return Estabelecimento
     */
    public function estabelecimento(): Estabelecimento
    {
        return $this->estabelecimento;
    }

    /**
     * @return Loja
     */
    public function loja(): Loja
    {
        return $this->loja;
    }

    /**
     * @return Venda
     */
    public function vendas(): Venda
    {
        return $this->venda;
    }

    /**
     * @return Ajuste
     */
    public function ajustes(): Ajuste
    {
        return $this->ajuste;
    }
}
