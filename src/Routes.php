<?php

namespace TeiaCardSdk;

class Routes
{
    public static function authentication(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->login = static function () {
            return 'oauth/token';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function adquirente(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/adquirente';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function bandeira(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/bandeira';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function campoDivergente(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/campo-divergente';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function motivoEstorno(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/motivo-estorno';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function motivoStatusConciliacao(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/motivo-status-conciliacao';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function tipoAjuste(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/ajuste-tipo';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function tipoBaixa(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/baixa-tipo';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function tipoInscricao(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/inscricao-tipo';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function tipoMaquineta(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/maquineta-tipo';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function tipoServico(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/servico-tipo';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function voucher(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/voucher';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function meioCaptura(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'enum/meio-captura';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function empresa(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->list = static function () {
            return 'retorno/empresas';
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function sales(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->send = static function () {
            return 'remessa/venda';
        };

        $anonymous->status = static function (int $id) {
            return "remessa/venda/{$id}/status";
        };

        return $anonymous;
    }

    /**
     * @return Anonymous
     */
    public static function ajusts(): Anonymous
    {
        $anonymous = new Anonymous();

        $anonymous->send = static function () {
            return 'remessa/ajustes';
        };

        return $anonymous;
    }
}

