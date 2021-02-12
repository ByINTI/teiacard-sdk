<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\Contracts\DataInterface;
use TeiaCardSdk\Data\Traits\FormatDataTrait;
use TeiaCardSdk\Data\DataTransferObject;

class Maquineta extends DataTransferObject
{
    use FormatDataTrait;

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
     * @var int
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
     * @param int $tipo
     * @return Maquineta
     */
    public function setTipo(int $tipo): Maquineta
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     * @return Maquineta
     * TODO: VOLTAR PARA INT
     */
    public function setNumero($numero): Maquineta
    {
        $this->numero = $numero;
        return $this;
    }
}
