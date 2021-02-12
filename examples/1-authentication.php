<?php

declare(strict_types=1);

use TeiaCardSdk\Client;
use TeiaCardSdk\Data\Requests\Autenticacao\Credenciais;
use TeiaCardSdk\Data\Requests\Venda\Adquirente;
use TeiaCardSdk\Data\Requests\Venda\Cartao;
use TeiaCardSdk\Data\Requests\Venda\Empresa;
use TeiaCardSdk\Data\Requests\Venda\Estabelecimento;
use TeiaCardSdk\Data\Requests\Venda\Loja;
use TeiaCardSdk\Data\Requests\Venda\Maquineta;
use TeiaCardSdk\Data\Requests\Venda\Venda;
use TeiaCardSdk\Data\Requests\Venda\Wrapper;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;

require_once __DIR__ . '/../vendor/autoload.php';


$redis = new Redis() or die("Cannot load Redis module.");
$redis->connect('redis');

try {
    $token = $redis->get('teia-card-access-token') ?: null;

    $teiaCard = new Client($token);

    if (!$token) {
        // AUTH
        $credentials = new Credenciais();
        $credentials->setClientId(getenv('CLIENT_ID'))
                    ->setClientSecret(getenv('CLIENT_SECRET'))
                    ->setUsername(getenv('USERNAME'))
                    ->setPassword(getenv('PASSWORD'))
//                    ->setRefreshToken(5.0)
//                    ->setRefreshToken('def502006934e235ab20451d41b33f7d35ea176b424f55a18456e8c4021a3ee8d07a15f1270fe0a4154491a3ca3916366e80ccbd485af28d672b3e578d50869f999b44c3d60b4fbb3b2f5d227f51c224916d64b8c5f5df7e7036556e7d2d82f3171b85582ce66340c03bdb3837cf0ad788206042c860f569e163e8cc66701a71262377a113ba6be6041194509cb61057474a0ca59ec26737c2e86c6bb479943a940a742b070fa75ebff221e0fcc38669f0280e5cf9f6af3982dea841b9ae3ea47aae4ffb046c99b24a099aa700794242bb3f08010f9abc7dc9ee1f46f07721ed6dabf83c41519133c717df0bbcf87065a96ac13872c8ccb0fcfd8660d296203d7264bf48661f7ccfeb115cf15e69cc8caeb8dc935e617545138bb3bb1a3fe7665be2d508542ec801246776aeb3614eb9e70da3866ad1151a2ede719997faedcf2232af69226450e640f9f3fd0e944395c8aa422990466e0b78630a4fe2bce6f3377a')
//                    ->setGrantTypeRefreshToken();
                    ->setGrantTypePassword();

        $authResponse = $teiaCard->autenticacao()->login($credentials);

        $redis->set(
            'teia-card-access-token',
            $authResponse->get('access_token'),
            $authResponse->get('expires_in')
        );

        $redis->set('teia-card-refresh-token', $authResponse->get('refresh_token'));

        $token = $authResponse->get('access_token');
    }

//    die('oi');

//    $teiaCard = new Client($token);

//    print_r($response->toJson()); die;
//    print_r($response->toArray()); die;

    // ISSO RETORNA UM 500: No query results for model [App\\Containers\\Safer\\Models\\RequestContent
//    $salesStatus = $teiaCard->vendas()->status(12001);
//    print_r($salesStatus); die;

//    $salesStatus = $teiaCard->vendas()->status(20103);
//    print_r($salesStatus); die;

//    $acquirerList = $teiaCard->adquirentes()->getList();
//    print_r($acquirerList->where('name', '=', 'Amex')->first());
//    echo PHP_EOL;
//
//    $bandeiras = $teiaCard->bandeiras()->getList();
//    print_r($bandeiras->first());
//    echo PHP_EOL;
//
//    $camposDivergentes = $teiaCard->campoDivergente()->getList();
//    print_r($camposDivergentes->first());
//    echo PHP_EOL;
//
//    $motivoEstorno = $teiaCard->motivoEstorno()->getList();
//    print_r($motivoEstorno->first());
//    echo PHP_EOL;
//
//    $motivoStatusConciliacao = $teiaCard->motivoStatusConciliacao()->getList();
//    print_r($motivoStatusConciliacao->first());
//    echo PHP_EOL;
//
//    $tipoAjuste = $teiaCard->tipoAjuste()->getList();
//    print_r($tipoAjuste->first());
//    echo PHP_EOL;
//
//    $tipoBaixa = $teiaCard->tipoBaixa()->getList();
//    print_r($tipoBaixa->first());
//    echo PHP_EOL;
//
//    $tipoInscricao = $teiaCard->tipoInscricao()->getList();
//    print_r($tipoInscricao->first());
//    echo PHP_EOL;
//
//    $tipoMaquineta = $teiaCard->tipoMaquineta()->getList();
//    print_r($tipoMaquineta->first());
//    echo PHP_EOL;
//
//    $tipoServico = $teiaCard->tipoServico()->getList();
//    print_r($tipoServico->first());
//    echo PHP_EOL;
//
//    $voucher = $teiaCard->voucher()->getList();
//    print_r($voucher->first());
//    echo PHP_EOL;

//    die('ok');

    $empresa = new Empresa();
    $empresa->setId(1)
            ->setNome('Teste 1')
            ->setInscricaoTipo(5)
            ->setInscricaoNumero('23823212000174');

    $loja = new Loja();
    $loja->setId(1)
         ->setInscricaoTipo(5)
         ->setInscricaoNumero('23823212000174');

    $maquineta = new Maquineta();
    $maquineta->setTipo(1);
    $maquineta->setNumero('555555555555555');

    $estabelecimento = new Estabelecimento();
    $estabelecimento->setNumero('88888');
    $estabelecimento->setMaquineta($maquineta);

    $adquirente = new Adquirente();
    $adquirente->setId(6);
    $adquirente->setEstabelecimento($estabelecimento);

    $cartao = new Cartao();
    $cartao->setNomeProprietario('Thiago Meireles da Silva');
    $cartao->setNumeroTruncado('4111XXXXXXXX1111');

    $venda = new Venda();
    $venda->setAdquirente($adquirente)
          ->setServicoTipo(1)
          ->setCartao($cartao)
//          ->setParcelas()
          ->setCaixaNumero('1111')
          ->setPedidoNumero('4444444444')
          ->setTaxa(0.23)
          ->setNsu('42341')
          ->setAutorizacao('123AVC')
          ->setVendaDataHora(date('Y-m-d H:i:s', strtotime('now -3 hours')))
          ->setValorBruto(5.32)
          ->setPlano(2)
          ->setBandeira(1)
          ->setCaixaNomeOperador('Thiago Meireles da Silva')
          ->setProgramaPromocional(false)
          ->setMeioCaptura(1)
          ->setVoucher(1)
          ->setGatewayPedidoId(3214)
//          ->setOperadoraTransporte(null)
          ->setChaveErp('INTIBR-123');

    $loja->addVenda($venda);

    $empresa->addLoja($loja);

    $wrapper = new Wrapper();
    $wrapper->addEmpresa($empresa);

    $response = $teiaCard->vendas()->send($wrapper);

    $redis->rPush('teia-card-vendas', $response->get('id'));

    print_r($response->toJson(JSON_PRETTY_PRINT));

    die("\n\nFIM\n\n");
//    print_r($teste2->getData()[0]); die;
//} catch (TeiaCardSdkBaseException $e) {
//    echo "\n############################## ERROR #############################\n#\n";
//    echo "# Status Code: {$e->getStatusCode()}\n";
//    echo "# Error: {$e->getError()}\n";
//    echo "# Description: {$e->getMessage()}\n";
//    echo "#\n###################################################################\n";
//    die;
//} catch (GuzzleHttp\Exception\BadResponseException $e) {
//    die('lululul');
//    echo $e->getResponse()->getBody()->getContents();
//    die("\n");
} catch (TeiaCardBaseException $e) {
    echo "\n#################################### FUDEUUUUUUUUUU ####################################\n#\n";
    echo '# Exception Type: ' . get_class($e) . "\n#\n";
    echo "# Status Code: {$e->getCode()}\n";
    echo "# Error: {$e->getError()}\n";
    echo "# Message: {$e->getMessage()}\n#\n";
    echo "# Trace: {$e->getTraceAsString()}\n#\n";
    echo "# Trace - Previous: {$e->getPrevious()->getTraceAsString()}\n";
    echo "#\n########################################################################################\n\n";
    die;
} catch (Throwable $e) {
    echo "\n############################## ERRO DO CÃO AQUI #############################\n#\n";
    echo "# Code: {$e->getCode()}\n";
    echo "# Message: {$e->getMessage()}\n#\n";
    echo "# Trace: {$e->getTraceAsString()}\n";
    echo "#\n###################################################################\n";
}
