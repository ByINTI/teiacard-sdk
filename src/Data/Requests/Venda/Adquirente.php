<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\DataTransferObject;
use TeiaCardSdk\Data\Traits\FormatDataTrait;

class Adquirente extends DataTransferObject
{
    use FormatDataTrait;

    /**
     * Enumerador Adquirente
     *
     * Type: Id
     *
     * @var int
     */
    private $id;

    /**
     * Objeto Estabelecimento
     *
     * Type: Object
     *
     * @var Maquineta
     */
    private $estabelecimento;

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
     * @return Adquirente
     */
    public function setId(int $id): Adquirente
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Maquineta
     */
    public function getEstabelecimento(): Maquineta
    {
        return $this->estabelecimento;
    }

    /**
     * @param  Estabelecimento  $estabelecimento
     *
     * @return Adquirente
     */
    public function setEstabelecimento(Estabelecimento $estabelecimento): Adquirente
    {
        $this->estabelecimento = $estabelecimento;

        return $this;
    }
}
