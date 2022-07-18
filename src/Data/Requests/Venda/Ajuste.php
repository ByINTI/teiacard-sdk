<?php

namespace TeiaCardSdk\Data\Requests\Venda;



use TeiaCardSdk\Data\DataTransferObject;

class Ajuste extends DataTransferObject
{
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
    private $valor_bruto_venda;

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
     * Enumerador Bandeira
     *
     * @var int
     */
    private $bandeira;

    /**
     * Data de Contato
     *
     * Formato AAAA-MM-DD HH:MM:SS
     * Exemplo: 2018-01-23 18:02:31
     * Type: Date
     *
     * @var string
     */
    private $data_contato;

    /**
     * Data solicitacao estorno
     *
     * Formato AAAA-MM-DD HH:MM:SS
     * Exemplo: 2018-01-23 18:02:31
     * Type: Date
     *
     * @var string
     */
    private $data_solicitacao_estorno;

    /**
     * Data efetivacao estorno
     *
     * Formato AAAA-MM-DD HH:MM:SS
     * Exemplo: 2018-01-23 18:02:31
     * Type: Date
     *
     * @var string
     */
    private $data_efetivacao_estorno;

    /**
     * Data prevista debitoa
     *
     * Formato AAAA-MM-DD HH:MM:SS
     * Exemplo: 2018-01-23 18:02:31
     * Type: Date
     *
     * @var string
     */
    private $data_prevista_debito;

    /**
     * Valor bruto
     *
     * Formato {8}.{2}
     * Exemplo 42321928.23
     * Type: Decimal
     *
     * @var float
     */
    private $valor_estorno;

    /**
     * Motivo de Estorno
     *
     * Type: Id
     *
     * @var int
     */
    private $motivo_estorno;

    /**
     * Usuario atendente
     *
     * Default value: null
     * Size range: 18
     * Type: String
     *
     * @var string|null
     */
    private $usuario_atendente;

    /**
     * Coordenador
     *
     * Default value: null
     * Size range: 18
     * Type: String
     *
     * @var string|null
     */
    private $coordenador;

    /**
     * Usuario Financeiro
     *
     * Default value: null
     * Size range: 18
     * Type: String
     *
     * @var string|null
     */
    private $usuario_financeiro;

    /**
     * TID.
     *
     * Default value: null
     * Size range: 20
     * Type: String
     *
     * @var string|null
     */
    private $tid;

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
     * @return Adquirente
     */
    public function getAdquirente(): Adquirente
    {
        return $this->adquirente;
    }

    /**
     * @param  Adquirente  $adquirente
     */
    public function setAdquirente(Adquirente $adquirente): Ajuste
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
     * @param  Cartao  $cartao
     */
    public function setCartao(Cartao $cartao): Ajuste
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
     * @param  int  $servico_tipo
     *
     * @return Ajuste
     */
    public function setServicoTipo(int $servico_tipo): Ajuste
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
     * @param  string|null  $caixa_numero
     */
    public function setCaixaNumero(?string $caixa_numero): Ajuste
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
     * @param  string|null  $pedido_numero
     */
    public function setPedidoNumero(?string $pedido_numero): Ajuste
    {
        $this->pedido_numero = $pedido_numero;

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
     * @param  string  $venda_data_hora
     */
    public function setVendaDataHora(string $venda_data_hora): Ajuste
    {
        $this->venda_data_hora = $venda_data_hora;

        return $this;
    }

    /**
     * @return float
     */
    public function getValorBruto(): float
    {
        return $this->valor_bruto_venda;
    }

    /**
     * @param  float  $valor_bruto
     */
    public function setValorBruto(float $valor_bruto): Ajuste
    {
        $this->valor_bruto_venda = $valor_bruto;

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
     * @param  string|null  $nsu
     */
    public function setNsu(?string $nsu): Ajuste
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
     * @param  string|null  $autorizacao
     */
    public function setAutorizacao(?string $autorizacao): Ajuste
    {
        $this->autorizacao = $autorizacao;

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
     * @param  int  $bandeira
     */
    public function setBandeira(int $bandeira): Ajuste
    {
        $this->bandeira = $bandeira;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataContato(): string
    {
        return $this->data_contato;
    }

    /**
     * @param  string  $data_contato
     */
    public function setDataContato(string $data_contato): Ajuste
    {
        $this->data_contato = $data_contato;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataSolicitacaoEstorno(): string
    {
        return $this->data_solicitacao_estorno;
    }

    /**
     * @param  string  $data_solicitacao_estorno
     */
    public function setDataSolicitacaoEstorno(string $data_solicitacao_estorno): Ajuste
    {
        $this->data_solicitacao_estorno = $data_solicitacao_estorno;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataEfetivacaoEstorno(): string
    {
        return $this->data_efetivacao_estorno;
    }

    /**
     * @param  string  $data_efetivacao_estorno
     */
    public function setDataEfetivacaoEstorno(string $data_efetivacao_estorno): Ajuste
    {
        $this->data_efetivacao_estorno = $data_efetivacao_estorno;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataPrevistaDebito(): string
    {
        return $this->data_prevista_debito;
    }

    /**
     * @param  string  $data_prevista_debito
     */
    public function setDataPrevistaDebito(string $data_prevista_debito): Ajuste
    {
        $this->data_prevista_debito = $data_prevista_debito;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsuarioAtendente(): ?string
    {
        return $this->usuario_atendente;
    }

    /**
     * @param  string|null  $usuario_atendente
     */
    public function setUsuarioAtendente(?string $usuario_atendente): Ajuste
    {
        $this->usuario_atendente = $usuario_atendente;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCoordenador(): ?string
    {
        return $this->coordenador;
    }

    /**
     * @param  string|null  $coordenador
     */
    public function setCoordenador(?string $coordenador): Ajuste
    {
        $this->coordenador = $coordenador;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsuarioFinanceiro(): ?string
    {
        return $this->usuario_financeiro;
    }

    /**
     * @param  string|null  $usuario_financeiro
     */
    public function setUsuarioFinanceiro(?string $usuario_financeiro): Ajuste
    {
        $this->usuario_financeiro = $usuario_financeiro;

        return $this;
    }

    /**
     * @return float
     */
    public function getValorEstorno(): float
    {
        return $this->valor_estorno;
    }

    /**
     * @param  float  $valor_estorno
     */
    public function setValorEstorno(float $valor_estorno): Ajuste
    {
        $this->valor_estorno = $valor_estorno;

        return $this;
    }

    /**
     * @return int
     */
    public function getMotivoEstorno(): int
    {
        return $this->motivo_estorno;
    }

    /**
     * @param  int  $motivo_estorno
     */
    public function setMotivoEstorno(int $motivo_estorno): Ajuste
    {
        $this->motivo_estorno = $motivo_estorno;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTid(): ?string
    {
        return $this->tid;
    }

    /**
     * @param  string|null  $tid
     */
    public function setTid(?string $tid): Ajuste
    {
        $this->tid = $tid;

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
     * @param  string|null  $chave_erp
     */
    public function setChaveErp(?string $chave_erp): Ajuste
    {
        $this->chave_erp = $chave_erp;

        return $this;
    }


}
