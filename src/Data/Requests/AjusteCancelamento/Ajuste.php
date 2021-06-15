<?php

namespace TeiaCardSdk\Data\Requests\AjusteCancelamento;

use TeiaCardSdk\Data\DataTransferObject;

class Ajuste extends DataTransferObject
{

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
     * Tipo da data a ser utilizada.
     * Baixa : Data de baixa dos ajustes
     * Previsao : Data da previsão de pagamento
     *
     * Size range: 25
     * Type: String
     *
     * @var string
     */
    private $tipo;

    /**
     * Data da Venda
     *
     * Formato AAAAMMDD
     * Exemplo: 20180123
     * Type: Date
     *
     * @var string
     */
    private $data;



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
    public function setTipo(string $tipo): Ajuste
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
    public function setData(string $data): Ajuste
    {
        $this->data = $data;

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
    public function setEmpresaCodigo(int $empresa_codigo): Ajuste
    {
        $this->empresa_codigo = $empresa_codigo;

        return $this;
    }

}
