<?php

function returnTest(): array
{
    echo "\n   ############################################\n";
    $AVAILABLE_RETURNS = [
        1  => 'empresa',
        2  => 'estabelecimento',
        3  => 'loja',
    ];

    echo "\n   ############################################\n";
    echo "\n   ############################################\n";
    echo "   #  Escolha qual Retornos deseja testar:  #\n";
    echo "   ############################################\n";
    echo "   #                                          #\n";
    echo "   #       0 - TODOS OS TESTES                #\n";
    echo "   #       1 - Empresas                       #\n";
    echo "   #       2 - Estabelecimentos               #\n";
    echo "   #       3 - Lojas                          #\n";
    echo "   #                                          #\n";
    echo "   ############################################\n";

    echo "\nDigite o numero referente ao teste que deseja e pressione ENTER\nou pressione ENTER sem informar nenhum numero para executar todos os testes de Retornos: ";

    $option = trim(fgets(STDIN));

    if ($option === "0") {
        $returnArr = [];

        foreach ($AVAILABLE_RETURNS as $key => $value) {
            $returnArr[] = [
                convertString($AVAILABLE_RETURNS[$key]),
                convertString($AVAILABLE_RETURNS[$key], '-', ' '),
            ];
        }

        return $returnArr;
    }

    if (!array_key_exists($option, $AVAILABLE_RETURNS)) {
        throw new InvalidArgumentException("RETORNO INVALIDO");
    }

    $functionName   = convertString($AVAILABLE_RETURNS[$option]);
    $returnsName = convertString($AVAILABLE_RETURNS[$option], '-', ' ');

    echo "\n# Retorno selecionado: `{$returnsName}`";

    return [$functionName, $returnsName];
}


function convertString($input, $separator = '-', $replaceWith = '')
{
    return str_replace($separator, $replaceWith, ucwords($input, $separator));
}
