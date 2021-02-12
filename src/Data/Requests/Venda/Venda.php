<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\Traits\FormatDataTrait;
use TeiaCardSdk\Data\DataTransferObject;

class Venda extends DataTransferObject
{
    use FormatDataTrait;

    /**
     * Objeto Adquirente
     *
     * Type: Object
     *
     * @var Adquirente
     */
    private $adquirente;

    /**
     * Objeto Cartao
     *
     * Type: Object
     *
     * @var Cartao
     */
    private $cartao;

    /**
     * Enumerador Tipo Serviço
     *
     * Type: Id
     *
     * @var int
     */
    private $servico_tipo;

    /**
     * Numero do Caixa
     *
     * Default value: null
     * Size range: 6
     * Type: String
     *
     * @var string|null
     */
    private $caixa_numero;

    /**
     * Numero do Pedido / Numero do Cupom Fiscal
     *
     * Exemplo pedido_numero: 0
     * Exemplo pedido_numero: "0000000"
     * Default value: null
     * Size range: 10
     * Type: Numeric
     *
     * @var string|null
     */
    private $pedido_numero;

    /**
     * Taxa
     *
     * Formato {2}.{2}
     * Exemplo 21.02
     * Default value: 0
     * Type: Decimal
     *
     * @var float
     */
    private $taxa = 0;

    /**
     * Numero NSU / CV ou DOC
     *
     * Default value: null
     * Size range: 20
     * Type: Numeric
     *
     * @var string|null
     */
    private $nsu;

    /**
     * Codigo de Autorizacao
     *
     * Default value: null
     * Size range: 10
     * Type: String
     *
     * @var string|null
     */
    private $autorizacao;

    /**
     * Data da Venda
     *
     * Formato AAAA-MM-DD HH:MM:SS
     * Exemplo: 2018-01-23 18:02:31
     * Type: Date
     *
     * @var string
     */
    private $venda_data_hora;

    /**
     * Valor bruto
     *
     * Formato {8}.{2}
     * Exemplo 42321928.23
     * Type: Decimal
     *
     * @var float
     */
    private $valor_bruto;

    /**
     * Plano (quantidade total de parcelas)
     *
     * Size range: 2
     * Type: Numeric
     *
     * @var int
     */
    private $plano;

    /**
     * Enumerador Bandeira
     *
     * @var int
     */
    private $bandeira;

    /**
     * Nome do operador do caixa
     *
     * Default value: null
     * Size range: 25
     * Type: String
     *
     * @var string|null
     */
    private $caixa_nome_operador;

    /**
     * É um programa promocional?
     *
     * Default value: false
     * Type: Boolean
     *
     * @var bool
     */
    private $programa_promocional = false;

    /**
     * Enumerador Meio de Captura
     *
     * Type: Id
     *
     * @var int
     */
    private $meio_captura;

    /**
     * Enumerador Voucher
     *
     * Default value: 2
     * Type: Id
     *
     * @var int
     */
    private $voucher = 2;

    /**
     * Identificação da venda no Gateway de pagamento.
     *
     * Exemplo: Id da venda na Mundipagg
     * Size range: 50
     * Type: String
     *
     * @var string
     */
    private $gateway_pedido_id;

    /**
     * Nome da operadora de transporte
     *
     * Default value: null
     * Size range: 25
     * Type: String
     *
     * @var string|null
     */
    private $operadora_transporte;

    /**
     * Chave no ERP.
     *
     * Default value: null
     * Size range: 50
     * Type: String
     *
     * @var string|null
     */
    private $chave_erp;

    /**
     * Objeto parcelas
     *
     * Default value: null
     * Type: Object[]
     *
     * @var Parcela[]|null
     */
    private $parcelas;

    /**
     * @return Adquirente
     */
    public function getAdquirente(): Adquirente
    {
        return $this->adquirente;
    }

    /**
     * @param Adquirente $adquirente
     * @return Venda
     */
    public function setAdquirente(Adquirente $adquirente): Venda
    {
        $this->adquirente = $adquirente;
        return $this;
    }

    /**
     * @return Cartao
     */
    public function getCartao(): Cartao
    {
        return $this->cartao;
    }

    /**
     * @param Cartao $cartao
     * @return Venda
     */
    public function setCartao(Cartao $cartao): Venda
    {
        $this->cartao = $cartao;
        return $this;
    }

    /**
     * @return int
     */
    public function getServicoTipo(): int
    {
        return $this->servico_tipo;
    }

    /**
     * @param int $servico_tipo
     * @return Venda
     */
    public function setServicoTipo(int $servico_tipo): Venda
    {
        $this->servico_tipo = $servico_tipo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCaixaNumero(): ?string
    {
        return $this->caixa_numero;
    }

    /**
     * @param string|null $caixa_numero
     * @return $this
     */
    public function setCaixaNumero(?string $caixa_numero): Venda
    {
        $this->caixa_numero = $caixa_numero;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPedidoNumero(): ?string
    {
        return $this->pedido_numero;
    }

    /**
     * @param string|null $pedido_numero
     * @return $this
     */
    public function setPedidoNumero(?string $pedido_numero): Venda
    {
        $this->pedido_numero = $pedido_numero;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxa(): float
    {
        return $this->taxa;
    }

    /**
     * @param float $taxa
     * @return Venda
     */
    public function setTaxa(float $taxa): Venda
    {
        $this->taxa = $taxa;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNsu(): ?string
    {
        return $this->nsu;
    }

    /**
     * @param string|null $nsu
     * @return $this
     */
    public function setNsu(?string $nsu): Venda
    {
        $this->nsu = $nsu;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAutorizacao(): ?string
    {
        return $this->autorizacao;
    }

    /**
     * @param string|null $autorizacao
     * @return $this
     */
    public function setAutorizacao(?string $autorizacao): Venda
    {
        $this->autorizacao = $autorizacao;
        return $this;
    }

    /**
     * @return string
     */
    public function getVendaDataHora(): string
    {
        return $this->venda_data_hora;
    }

    /**
     * @param string $venda_data_hora
     * @return Venda
     */
    public function setVendaDataHora(string $venda_data_hora): Venda
    {
        $this->venda_data_hora = $venda_data_hora;
        return $this;
    }

    /**
     * @return float
     */
    public function getValorBruto(): float
    {
        return $this->valor_bruto;
    }

    /**
     * @param float $valor_bruto
     * @return Venda
     */
    public function setValorBruto(float $valor_bruto): Venda
    {
        $this->valor_bruto = $valor_bruto;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlano(): int
    {
        return $this->plano;
    }

    /**
     * @param int $plano
     * @return Venda
     */
    public function setPlano(int $plano): Venda
    {
        $this->plano = $plano;
        return $this;
    }

    /**
     * @return int
     */
    public function getBandeira(): int
    {
        return $this->bandeira;
    }

    /**
     * @param int $bandeira
     * @return Venda
     */
    public function setBandeira(int $bandeira): Venda
    {
        $this->bandeira = $bandeira;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCaixaNomeOperador(): ?string
    {
        return $this->caixa_nome_operador;
    }

    /**
     * @param string|null $caixa_nome_operador
     * @return $this
     */
    public function setCaixaNomeOperador(?string $caixa_nome_operador): Venda
    {
        $this->caixa_nome_operador = $caixa_nome_operador;
        return $this;
    }

    /**
     * @return bool
     */
    public function isProgramaPromocional(): bool
    {
        return $this->programa_promocional;
    }

    /**
     * @param bool $programa_promocional
     * @return Venda
     */
    public function setProgramaPromocional(bool $programa_promocional): Venda
    {
        $this->programa_promocional = $programa_promocional;
        return $this;
    }

    /**
     * @return int
     */
    public function getMeioCaptura(): int
    {
        return $this->meio_captura;
    }

    /**
     * @param int $meio_captura
     * @return Venda
     */
    public function setMeioCaptura(int $meio_captura): Venda
    {
        $this->meio_captura = $meio_captura;
        return $this;
    }

    /**
     * @return int
     */
    public function getVoucher(): int
    {
        return $this->voucher;
    }

    /**
     * @param int $voucher
     * @return Venda
     */
    public function setVoucher(int $voucher): Venda
    {
        $this->voucher = $voucher;
        return $this;
    }

    /**
     * @return string
     */
    public function getGatewayPedidoId(): string
    {
        return $this->gateway_pedido_id;
    }

    /**
     * @param string $gateway_pedido_id
     * @return Venda
     * TODO: VOLTAR PARA STRING
     */
    public function setGatewayPedidoId($gateway_pedido_id): Venda
    {
        $this->gateway_pedido_id = $gateway_pedido_id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOperadoraTransporte(): ?string
    {
        return $this->operadora_transporte;
    }

    /**
     * @param string|null $operadora_transporte
     * @return $this
     */
    public function setOperadoraTransporte(?string $operadora_transporte): Venda
    {
        $this->operadora_transporte = $operadora_transporte;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getChaveErp(): ?string
    {
        return $this->chave_erp;
    }

    /**
     * @param string|null $chave_erp
     * @return $this
     */
    public function setChaveErp(?string $chave_erp): Venda
    {
        $this->chave_erp = $chave_erp;
        return $this;
    }

    /**
     * @return Parcela[]|null
     */
    public function getParcelas(): ?array
    {
        return $this->parcelas;
    }

    /**
     * @param Parcela[]|null $parcelas
     * @return $this
     */
    public function setParcelas(?array $parcelas): Venda
    {
        $this->parcelas = $parcelas;
        return $this;
    }

    /**
     * @param Parcela $parcela
     * @return $this
     */
    public function addParcela(Parcela $parcela): Venda
    {
        $this->parcelas[] = $parcela;
        return $this;
    }
}
