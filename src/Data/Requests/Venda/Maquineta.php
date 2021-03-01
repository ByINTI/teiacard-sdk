<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\DataTransferObject;

class Maquineta extends DataTransferObject
{
    /**
     * Enumerador Tipo de Maquineta
     *
     * Type: Id
     *
     * @var int
     */
    private $tipo;

    /**
     * Numero da maquineta
     *
     * Size range: 15
     * Type: Numeric
     *
     * @var string
     */
    private $numero;

    /**
     * @return int
     */
    public function getTipo(): int
    {
        return $this->tipo;
    }

    /**
     * @param  int  $tipo
     *
     * @return Maquineta
     */
    public function setTipo(int $tipo): Maquineta
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumero(): string
    {
        return $this->numero;
    }

    /**
     * @param  string  $numero
     *
     * @return Maquineta
     */
    public function setNumero(string $numero): Maquineta
    {
        $this->numero = $numero;

        return $this;
    }
}
