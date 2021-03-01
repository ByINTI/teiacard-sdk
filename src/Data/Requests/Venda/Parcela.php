<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\DataTransferObject;
use TeiaCardSdk\Data\Traits\FormatDataTrait;

class Parcela extends DataTransferObject
{
    use FormatDataTrait;

    /**
     * Número da parcela
     *
     * Size range: 2
     * Type: Numeric
     *
     * @var int
     */
    private $numero;

    /**
     * Data de vencimento da parcela
     *
     * Formato AAAA-MM-DD
     * Exemplo: 2018-01-23
     * Type: Date
     *
     * @var string
     */
    private $data_vencimento;

    /**
     * Valor bruto da parcela
     *
     * Formato {8}.{2}
     * Exemplo 42321928.23
     * Type: Decimal
     *
     * @var float
     */
    private $valor_bruto;

    /**
     * Valor líquido da parcela
     *
     * Formato {8}.{2}
     * Exemplo 42321928.23
     * Type: Decimal
     *
     * @var float
     */
    private $valor_liquido;

    /**
     * Chave da parcela
     *
     * Size range: 50
     * Type: String
     *
     * @var string
     */
    private $chave_parcela;

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param  int  $numero
     *
     * @return Parcela
     */
    public function setNumero(int $numero): Parcela
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataVencimento(): string
    {
        return $this->data_vencimento;
    }

    /**
     * @param  string  $data_vencimento
     *
     * @return Parcela
     */
    public function setDataVencimento(string $data_vencimento): Parcela
    {
        $this->data_vencimento = $data_vencimento;

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
     * @param  float  $valor_bruto
     *
     * @return Parcela
     */
    public function setValorBruto(float $valor_bruto): Parcela
    {
        $this->valor_bruto = $valor_bruto;

        return $this;
    }

    /**
     * @return float
     */
    public function getValorLiquido(): float
    {
        return $this->valor_liquido;
    }

    /**
     * @param  float  $valor_liquido
     *
     * @return Parcela
     */
    public function setValorLiquido(float $valor_liquido): Parcela
    {
        $this->valor_liquido = $valor_liquido;

        return $this;
    }

    /**
     * @return string
     */
    public function getChaveParcela(): string
    {
        return $this->chave_parcela;
    }

    /**
     * @param  string  $chave_parcela
     *
     * @return Parcela
     */
    public function setChaveParcela(string $chave_parcela): Parcela
    {
        $this->chave_parcela = $chave_parcela;

        return $this;
    }
}
