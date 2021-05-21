<?php

declare(strict_types = 1);

use TeiaCardSdk\Client;
use TeiaCardSdk\Data\Requests\Autenticacao\Credenciais;
use TeiaCardSdk\Data\Requests\Venda\Adquirente;
use TeiaCardSdk\Data\Requests\Venda\Ajuste;
use TeiaCardSdk\Data\Requests\Venda\Cartao;
use TeiaCardSdk\Data\Requests\Venda\Empresa;
use TeiaCardSdk\Data\Requests\Venda\Estabelecimento;
use TeiaCardSdk\Data\Requests\Venda\Loja;
use TeiaCardSdk\Data\Requests\Venda\Maquineta;
use TeiaCardSdk\Data\Requests\Venda\Venda;
use TeiaCardSdk\Data\Requests\Venda\Wrapper;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;

require_once __DIR__ . '/../vendor/autoload.php';

echo "############################################################################################";
$redis = new Redis() or die("Cannot load Redis module.");
$redis->connect('redis');

echo "\n\n# Inicio do teste de envio de Venda\n";

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

    echo "\n# Criando objeto Empresa...\n";
    $empresa = new Empresa();
    $empresa->setId(1)
            ->setNome('Teste 1')
            ->setInscricaoTipo(5)
            ->setInscricaoNumero('23823212000174');

    echo "\n# Criando objeto Loja...\n";
    $loja = new Loja();
    $loja->setId(1)
         ->setInscricaoTipo(5)
         ->setInscricaoNumero('23823212000174');

    echo "\n# Criando objeto Maquineta...\n";
    $maquineta = new Maquineta();
    $maquineta->setTipo(1);
    $maquineta->setNumero('555555555555555');

    echo "\n# Criando objeto Estabelecimento...\n";
    $estabelecimento = new Estabelecimento();
    $estabelecimento->setNumero('88888');
    $estabelecimento->setMaquineta($maquineta);

    echo "\n# Criando objeto Adquirente...\n";
    $adquirente = new Adquirente();
    $adquirente->setId(6);
    $adquirente->setEstabelecimento($estabelecimento);

    echo "\n# Criando objeto Cartao...\n";
    $cartao = new Cartao();
    $cartao->setNomeProprietario('Thiago Meireles da Silva');
    $cartao->setNumeroTruncado('4111XXXXXXXX1111');

    echo "\n# Criando objeto Venda...\n";
    $ajuste = new Ajuste();
    $ajuste->setAdquirente($adquirente)
           ->setServicoTipo(1)
           ->setCartao($cartao)
           ->setCaixaNumero('1111')
           ->setPedidoNumero('4444444444')
           ->setVendaDataHora(date('Y-m-d H:i:s', strtotime('now -3 hours')))
           ->setValorBruto(5.32)
           ->setNsu('42341')
           ->setAutorizacao('123AVC')
           ->setBandeira(1)
           ->setDataContato(date('Y-m-d H:i:s', strtotime('now -3 hours')))
           ->setDataSolicitacaoEstorno(date('Y-m-d H:i:s', strtotime('now -3 hours')))
           ->setDataEfetivacaoEstorno(date('Y-m-d H:i:s', strtotime('now -3 hours')))
           ->setDataPrevistaDebito(date('Y-m-d H:i:s', strtotime('now -3 hours')))
           ->setUsuarioAtendente('Thiago Meireles da Silva')
           ->setCoordenador('Thiago Meireles da Silva')
           ->setUsuarioFinanceiro('Thiago Meireles da Silva')
           ->setValorEstorno(5.32)
           ->setMotivoEstorno(1)
           ->setTid('TESTE')
           ->setChaveErp('INTIBR-123');

    echo "\n# Adicionando objeto Venda a Loja...\n";
    $loja->addAjuste($ajuste);

    echo "\n# Adicionando objeto Loja a Empresa...\n";
    $empresa->addLoja($loja);

    echo "\n# Criando objeto Wrapper...\n";
    $wrapper = new Wrapper();
    echo "\n# Adicionando objeto Empresa ao Wrapper...\n";
    $wrapper->addEmpresa($empresa);

    echo "\n# Iniciando requisição de envio de Ajustes...\n";
    $response = $teiaCard->ajustes()->send($wrapper);
    echo "\n# Retorno da Teia Card recebido:\n\n";

    $redis->rPush('teia-card-vendas', $response->get('id'));

    echo $response->toJson(JSON_PRETTY_PRINT);
    echo "\n\n# Teste de envio de Venda realizado com sucesso!\n\n";
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
