<?php

function enumeratorTest(): array
{
    $AVAILABLE_ENUMERATORS = [
        1  => 'adquirentes',
        2  => 'bandeiras',
        3  => 'campo-divergente',
        4  => 'motivo-estorno',
        5  => 'motivo-status-conciliacao',
        6  => 'tipo-ajuste',
        7  => 'tipo-baixa',
        8  => 'tipo-inscricao',
        9  => 'tipo-maquineta',
        10 => 'tipo-servico',
        11 => 'voucher',
        12 => 'meio-captura',
    ];

    echo "\n   ############################################\n";
    echo "   #  Escolha qual Enumerador deseja testar:  #\n";
    echo "   ############################################\n";
    echo "   #                                          #\n";
    echo "   #       0 - TODOS OS TESTES                #\n";
    echo "   #       1 - Adquirentes                    #\n";
    echo "   #       2 - Bandeiras                      #\n";
    echo "   #       3 - Campo Divergente               #\n";
    echo "   #       4 - Motivo Estorno                 #\n";
    echo "   #       5 - Motivo Status Conciliacao      #\n";
    echo "   #       6 - Tipo Ajuste                    #\n";
    echo "   #       7 - Tipo Baixa                     #\n";
    echo "   #       8 - Tipo Inscricao                 #\n";
    echo "   #       9 - Tipo Maquineta                 #\n";
    echo "   #      10 - Tipo Servico                   #\n";
    echo "   #      11 - Voucher                        #\n";
    echo "   #      12 - Meio Captura                   #\n";
    echo "   #                                          #\n";
    echo "   ############################################\n";

    echo "\nDigite o numero referente ao teste que deseja e pressione ENTER\nou pressione ENTER sem informar nenhum numero para executar todos os testes de Enumeradores: ";

    $option = trim(fgets(STDIN));

    if ($option === "0") {
        $returnArr = [];

        foreach ($AVAILABLE_ENUMERATORS as $key => $value) {
            $returnArr[] = [
                convertString($AVAILABLE_ENUMERATORS[$key]),
                convertString($AVAILABLE_ENUMERATORS[$key], '-', ' '),
            ];
        }

        return $returnArr;
    }

    if (!array_key_exists($option, $AVAILABLE_ENUMERATORS)) {
        throw new InvalidArgumentException("ENUMERADOR INVALIDO");
    }

    $functionName   = convertString($AVAILABLE_ENUMERATORS[$option]);
    $enumeratorName = convertString($AVAILABLE_ENUMERATORS[$option], '-', ' ');

    echo "\n# Enumerador selecionado: `{$enumeratorName}`";

    return [$functionName, $enumeratorName];
}

function convertString($input, $separator = '-', $replaceWith = '')
{
    return str_replace($separator, $replaceWith, ucwords($input, $separator));
}
