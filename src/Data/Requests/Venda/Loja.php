<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\DataTransferObject;
use TeiaCardSdk\Data\Traits\FormatDataTrait;

class Loja extends DataTransferObject
{
    use FormatDataTrait;

    /**
     * Codigo da Loja
     *
     * Size range: 3
     * Type: Numeric
     *
     * @var int
     */
    private $id;

    /**
     * Enumerador Tipo de Inscrição
     *
     * Type: Id
     *
     * @var int
     */
    private $inscricao_tipo;

    /**
     * Numero de inscrição (CNPJ, CPF, Outros). Sem pontuação.
     *
     * Exemplo: 51533811881
     * Size range: 14
     * Type: Numeric
     *
     * @var string
     */
    private $inscricao_numero;

    /**
     * Lista de Vendas
     *
     * Type: Object[]
     *
     * @var Venda[]
     */
    private $vendas;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param  int  $id
     *
     * @return Loja
     */
    public function setId(int $id): Loja
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getInscricaoTipo(): int
    {
        return $this->inscricao_tipo;
    }

    /**
     * @param  int  $inscricao_tipo
     *
     * @return Loja
     */
    public function setInscricaoTipo(int $inscricao_tipo): Loja
    {
        $this->inscricao_tipo = $inscricao_tipo;

        return $this;
    }

    /**
     * @return string
     */
    public function getInscricaoNumero(): string
    {
        return $this->inscricao_numero;
    }

    /**
     * @param  string  $inscricao_numero
     *
     * @return Loja
     */
    public function setInscricaoNumero(string $inscricao_numero): Loja
    {
        $this->inscricao_numero = $inscricao_numero;

        return $this;
    }

    /**
     * @return Venda[]
     */
    public function getVendas(): array
    {
        return $this->vendas;
    }

    /**
     * @param  Venda[]  $vendas
     *
     * @return Loja
     */
    public function setVendas(array $vendas): Loja
    {
        $this->vendas = $vendas;

        return $this;
    }

    /**
     * @param  Venda  $venda
     *
     * @return Loja
     */
    public function addVenda(Venda $venda): Loja
    {
        $this->vendas[] = $venda;

        return $this;
    }
}
