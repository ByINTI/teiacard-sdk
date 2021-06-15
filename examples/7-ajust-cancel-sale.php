<?php

declare(strict_types = 1);

use TeiaCardSdk\Client;
use TeiaCardSdk\Data\Requests\AjusteCancelamento\Ajuste;
use TeiaCardSdk\Data\Requests\Autenticacao\Credenciais;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;

require_once __DIR__ . '/../vendor/autoload.php';

echo "############################################################################################";
$redis = new Redis() or die("Cannot load Redis module.");
$redis->connect('redis');

echo "\n\n# Inicio do teste de consulta de Ajustes de Cancelamento\n";

try {
    $token        = $redis->get('teia-card-access-token') ?: null;
    $refreshToken = $redis->get('teia-card-refresh-token') ?: null;

    $teiaCard = new Client(false, $token);

    if (!$token) {
        echo "\n# Token nao encontrado no Redis\n";
        echo "\n# Iniciando autenticacao com username/password...\n";

        $credentials = new Credenciais();
        $credentials->setClientId(getenv('CLIENT_ID'))
                    ->setClientSecret(getenv('CLIENT_SECRET'));

        if ($refreshToken) {
            $credentials->setRefreshToken($refreshToken)
                        ->setGrantTypeRefreshToken();
        } else {
            $credentials->setUsername(getenv('USERNAME'))
                        ->setPassword(getenv('PASSWORD'))
                        ->setGrantTypePassword();
        }

        $authResponse = $teiaCard->autenticacao()->login($credentials);

        echo "\n# Resposta da autenticacao:\n\n";
        echo $authResponse->toJson(JSON_PRETTY_PRINT);

        $token = $authResponse->get('access_token');

        $redis->set(
            'teia-card-access-token',
            $token,
            $authResponse->get('expires_in')
        );

        $redis->set(
            'teia-card-refresh-token',
            $authResponse->get('refresh_token'),
            $authResponse->get(24 * 60 * 60)
        );

        echo "\n\n# Token e Refresh Token setados no Redis\n";
    }

    echo "\n# Criando de consulta de Ajustes Empresa...\n";
    $ajusteCancelamento = new Ajuste();
    $ajusteCancelamento ->setData('20180123')
                        ->setTipo('baixa')
                        ->setEmpresaCodigo(1);

    echo "\n# Iniciando requisição de envio de Ajustes...\n";
    $teiaCard->ajustesCancelamentos()->setAjuste($ajusteCancelamento);
    $response = $teiaCard->ajustesCancelamentos()->list();

    echo "\n# Retorno da Teia Card recebido:\n\n";

    $redis->rPush('teia-card-ajustes', $response->get('id'));

    echo $response->toJson(JSON_PRETTY_PRINT);
    echo "\n\n# Teste de envio de ajustes realizado com sucesso!\n\n";
} catch (TeiaCardBaseException $e) {
    echo "\n#################################### ERRO DE RESPOSTA DA TEIA CARD ####################################\n#\n";
    echo '# Exception Type: ' . get_class($e) . "\n#\n";
    echo "# Status Code: {$e->getCode()}\n";
    echo "# Error: {$e->getError()}\n";
    echo "# Message: {$e->getMessage()}\n#\n";
    echo "# Trace: {$e->getTraceAsString()}\n#\n";

    if ($e->getPrevious()) {
        echo "# Trace - Previous: {$e->getPrevious()->getTraceAsString()}\n";
    }

    echo "#\n########################################################################################\n\n";
    die;
} catch (Throwable $e) {
    echo "\n############################## FATAL ERROR - NAO ESPERADO #############################\n#\n";
    echo "# Code: {$e->getCode()}\n";
    echo "# Message: {$e->getMessage()}\n#\n";
    echo "# Trace: {$e->getTraceAsString()}\n";
    echo "#\n###################################################################\n";
}
