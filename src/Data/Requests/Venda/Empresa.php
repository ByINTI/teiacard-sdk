<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\DataTransferObject;
use TeiaCardSdk\Data\Traits\FormatDataTrait;

/**
 * Class Empresa
 *
 * @package TeiaCardSdk\Data\Requests\Sale
 */
class Empresa extends DataTransferObject
{
    use FormatDataTrait;

    /**
     * Codigo da empresa
     *
     * Size range: 3
     * Type: Numeric
     *
     * @var int
     */
    private $id;

    /**
     * Nome da empresa
     *
     * Default value: null
     * Size range: 25
     * Type: String
     *
     * @var string|null
     */
    private $nome;

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
     * Lista de Lojas
     *
     * Type: Object[]
     *
     * @var Loja[]
     */
    private $lojas;

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
     * @return Empresa
     */
    public function setId(int $id): Empresa
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * @param  string|null  $nome
     *
     * @return $this
     */
    public function setNome(?string $nome): Empresa
    {
        $this->nome = $nome;

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
     * @return Empresa
     */
    public function setInscricaoTipo(int $inscricao_tipo): Empresa
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
     * @return Empresa
     */
    public function setInscricaoNumero(string $inscricao_numero): Empresa
    {
        $this->inscricao_numero = $inscricao_numero;

        return $this;
    }

    /**
     * @return Loja[]
     */
    public function getLojas(): array
    {
        return $this->lojas;
    }

    /**
     * @param  Loja[]  $lojas
     *
     * @return Empresa
     */
    public function setLojas(array $lojas): Empresa
    {
        $this->lojas = $lojas;

        return $this;
    }

    public function addLoja(Loja $loja): Empresa
    {
        $this->lojas[] = $loja;

        return $this;
    }
}
