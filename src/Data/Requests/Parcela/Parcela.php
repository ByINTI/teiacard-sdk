<?php

namespace TeiaCardSdk\Data\Requests\Parcela;

use TeiaCardSdk\Data\DataTransferObject;

class Parcela extends DataTransferObject
{
    /**
     * Tipo da data a ser utilizada.
     * Baixa : Data de baixa dos ajustes
     * Venda: Retorno das parcelas conciliadas com a adquirente
     * Ocorrência: Retorno das parcelas que sofreram alguma modificação (
     *             Ex: Aceleração de parcelas, Desagendamento de parcelas, Antecipação das parcelas,...)
     * Valores permitidos: {"baixa, venda, ocorrencia"}
     * Size range: 25
     * Type: String
     *
     * @var string
     */
    private $tipo;

    /**
     * Data da Venda
     * Tipo baixa : Data do processamento/conciliação do pagamento.
     * Tipo venda: Data da conciliação da venda.
     * Tipo ocorrencia: Data do processamento da ocorrência.
     * Dessa forma a integração pode ser realizada diariamente consultando apenas o que foi conciliado/processado
     * no dia anterior. Sem a necessidade de consultar datas retroativas caso a venda não seja conciliada sempre
     * no dia em que foi recebida, ou se o pagamento demore a ser processado por alguma pendência operacional.
     * Formato AAAAMMDD
     * Exemplo: 20180123
     * Type: Date
     *
     * @var string
     */
    private $data;

    /**
     * Codigo do serviço
     *
     * Size range: 3
     * Type: Numeric
     *
     * @var int
     */
    private $tipo_servico;

    /**
     * Codigo do adquirente
     *
     * Size range: 3
     * Type: Numeric
     *
     * @var int
     */
    private $adquirente_id;

    /**
     * Codigo da empresa
     *
     * Size range: 3
     * Type: Numeric
     *
     * @var int
     */
    private $empresa_codigo;

    /**
     * Paginação: Quantidade de registros por pagina
     * @var int
     */
    private $limit;

    /**
     * Paginação: pagina atual
     * @var int
     */
    private $page;

    /**
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @param  string  $tipo
     */
    public function setTipo(string $tipo): Parcela
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param  string  $data
     */
    public function setData(string $data): Parcela
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return int
     */
    public function getTipoServico(): int
    {
        return $this->tipo_servico;
    }

    /**
     * @param  int  $tipo_servico
     */
    public function setTipoServico(int $tipo_servico): Parcela
    {
        $this->tipo_servico = $tipo_servico;
        return $this;
    }

    /**
     * @return int
     */
    public function getAdquirenteId(): int
    {
        return $this->adquirente_id;
    }

    /**
     * @param  int  $adquirente_id
     */
    public function setAdquirenteId(int $adquirente_id): Parcela
    {
        $this->adquirente_id = $adquirente_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getEmpresaCodigo(): int
    {
        return $this->empresa_codigo;
    }

    /**
     * @param  int  $empresa_codigo
     */
    public function setEmpresaCodigo(int $empresa_codigo): Parcela
    {
        $this->empresa_codigo = $empresa_codigo;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param  int  $limit
     */
    public function setLimit(int $limit): Parcela
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param  int  $page
     */
    public function setPage(int $page): Parcela
    {
        $this->page = $page;
        return $this;
    }

}
