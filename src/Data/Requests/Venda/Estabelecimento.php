<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\DataTransferObject;
use TeiaCardSdk\Data\Traits\FormatDataTrait;

class Estabelecimento extends DataTransferObject
{
    use FormatDataTrait;

    /**
     * Numero do estabelecimento
     *
     * Size range: 18
     * Type: Numeric
     *
     * @var string
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
     * @return string
     */
    public function getNumero(): string
    {
        return $this->numero;
    }

    /**
     * @param  string  $numero
     *
     * @return Estabelecimento
     */
    public function setNumero(string $numero): Estabelecimento
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
     * @param  Maquineta  $maquineta
     *
     * @return Estabelecimento
     */
    public function setMaquineta(Maquineta $maquineta): Estabelecimento
    {
        $this->maquineta = $maquineta;

        return $this;
    }
}
