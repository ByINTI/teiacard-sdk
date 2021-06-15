<?php

namespace TeiaCardSdk\Data\Requests\Parcela;

use TeiaCardSdk\Data\DataTransferObject;

class ParcelaNaoConciliada extends DataTransferObject
{
    /**
     * Tipo da data a ser utilizada.
     * Baixa : Data de baixa dos ajustes
     * Venda: Retorno das parcelas conciliadas com a adquirente
     * Size range: 25
     * Type: String
     *
     * @var string
     */
    private $tipo_data;

    /**
     * Data do processamento/conciliação da venda.
     * Formato AAAAMMDD
     * Exemplo: 20180123
     *
     * Type: Date
     *
     * @var string
     */
    private $data;

    /**
     * Enumerador Motivo Status Conciliacao
     * Não Conciliado:
     *      Retorno das parcelas não conciliadas
     * Não Conciliadas - Não encontrada no ERP:
     *      Retorno das parcelas não conciliadas e não encontradas no ERP
     * Não Conciliadas - Informações divergentes:
     *    Retorno das parcelas não conciliadas com informações divergentes
     *
     *  Valores permitidos: {"1, 2, 3"}
     *
     * Size range: 3
     * Type: Numeric
     *
     * @var int
     */
    private $status_conciliacao;

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
    public function getTipoData(): string
    {
        return $this->tipo_data;
    }

    /**
     * @param  string  $tipo_data
     */
    public function setTipoData(string $tipo_data): ParcelaNaoConciliada
    {
        $this->tipo_data = $tipo_data;
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
    public function setData(string $data): ParcelaNaoConciliada
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusConciliacao(): int
    {
        return $this->status_conciliacao;
    }

    /**
     * @param  int  $status_conciliacao
     */
    public function setStatusConciliacao(int $status_conciliacao): ParcelaNaoConciliada
    {
        $this->status_conciliacao = $status_conciliacao;
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
    public function setLimit(int $limit): ParcelaNaoConciliada
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
    public function setPage(int $page): ParcelaNaoConciliada
    {
        $this->page = $page;
        return $this;
    }

}
