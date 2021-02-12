<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\Contracts\DataInterface;
use TeiaCardSdk\Data\Traits\FormatDataTrait;
use TeiaCardSdk\Data\DataTransferObject;

class Estabelecimento extends DataTransferObject
{
    use FormatDataTrait;

    /**
     * Numero do estabelecimento
     *
     * Size range: 18
     * Type: Numeric
     *
     * @var int
     */
    private $numero;

    /**
     * Objeto Maquineta
     *
     * Type: Object
     *
     * @var Maquineta
     */
    private $maquineta;

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     * @return Estabelecimento
     * TODO: VOLTAR PARA INT
     */
    public function setNumero($numero): Estabelecimento
    {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return Maquineta
     */
    public function getMaquineta(): Maquineta
    {
        return $this->maquineta;
    }

    /**
     * @param Maquineta $maquineta
     * @return Estabelecimento
     */
    public function setMaquineta(Maquineta $maquineta): Estabelecimento
    {
        $this->maquineta = $maquineta;
        return $this;
    }
}
