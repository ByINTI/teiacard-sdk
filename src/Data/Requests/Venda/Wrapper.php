<?php

namespace TeiaCardSdk\Data\Requests\Venda;

use TeiaCardSdk\Data\DataTransferObject;

class Wrapper extends DataTransferObject
{
    /**
     * Lista de Empresas
     *
     * Type: Object[]
     *
     * @var Empresa[]
     */
    private $empresas;

    /**
     * @return Empresa[]
     */
    public function getEmpresas(): ?array
    {
        return $this->empresas;
    }

    /**
     * @param  Empresa[]  $empresas
     *
     * @return $this
     */
    public function setEmpresas(array $empresas): Wrapper
    {
        $this->empresas = $empresas;

        return $this;
    }

    /**
     * @param  Empresa  $parcela
     *
     * @return $this
     */
    public function addEmpresa(Empresa $parcela): Wrapper
    {
        $this->empresas[] = $parcela;

        return $this;
    }
}
