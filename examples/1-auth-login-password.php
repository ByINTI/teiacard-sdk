<?php

declare(strict_types = 1);

use TeiaCardSdk\Client;
use TeiaCardSdk\Data\Requests\Autenticacao\Credenciais;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;

require_once __DIR__ . '/../vendor/autoload.php';

echo "\n############################################################################################\n";
$redis = new Redis() or die("Cannot load Redis module.");
$redis->connect('redis');

try {
    $teiaCard = new Client();

    echo "\n# Criando objeto com as credenciais de autenticação...\n";
    $credentials = new Credenciais();
    $credentials->setClientId(getenv('CLIENT_ID'))
                ->setClientSecret(getenv('CLIENT_SECRET'))
                ->setUsername(getenv('USERNAME'))
                ->setPassword(getenv('PASSWORD'))
                ->setGrantTypePassword();

    echo "\n# Iniciando requisição de autenticacao utilizando username/password...\n";
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

    echo "\n# Teste de Login via username/password finalizado com sucesso  #\n\n";
} catch (TeiaCardBaseException $e) {
    echo "\n############################## ERRO DE RESPOSTA DA TEIA CARD ##############################\n#\n";
    echo '# Exception Type: ' . get_class($e) . "\n#\n";
    echo "# Status Code: {$e->getCode()}\n";
    echo "# Error: {$e->getError()}\n";
    echo "# Message: {$e->getMessage()}\n#\n";
    echo "# Trace: {$e->getTraceAsString()}\n#\n";

    if ($e->getPrevious()) {
        echo "# Trace - Previous: {$e->getPrevious()->getTraceAsString()}\n";
    }

    echo "#\n###########################################################################################\n\n";
    die;
} catch (Throwable $e) {
    echo "\n############################## ERRO INESPERADO ##############################\n#\n";
    echo "# Code: {$e->getCode()}\n";
    echo "# Message: {$e->getMessage()}\n#\n";
    echo "# Trace: {$e->getTraceAsString()}\n";
    echo "#\n#############################################################################\n";
}
