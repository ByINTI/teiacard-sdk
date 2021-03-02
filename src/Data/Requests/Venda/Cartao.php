<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\DataTransferObject;

class Cartao extends DataTransferObject
{
    /**
     * Numero do cartão truncado
     *
     * Exemplo: 12231XXXXX12312 12XXXXXXX12312
     * Default value: null
     * Size range: 19
     * Type: String
     *
     * @var string
     */
    private $numero_truncado;

    /**
     * Nome do Proprietario do cartão
     *
     * Default value: null
     * Size range: 25
     * Type: String
     *
     * @var String
     */
    private $nome_proprietario;

    /**
     * @return string|null
     */
    public function getNumeroTruncado(): ?string
    {
        return $this->numero_truncado;
    }

    /**
     * @param  string|null  $numero_truncado
     *
     * @return $this
     */
    public function setNumeroTruncado(?string $numero_truncado): Cartao
    {
        $this->numero_truncado = $numero_truncado;

        return $this;
    }

    /**
     * @return String
     */
    public function getNomeProprietario(): string
    {
        return $this->nome_proprietario;
    }

    /**
     * @param  String  $nome_proprietario
     *
     * @return Cartao
     */
    public function setNomeProprietario(string $nome_proprietario): Cartao
    {
        $this->nome_proprietario = $nome_proprietario;

        return $this;
    }
}
