# SDK Teia Card

SDK criado com objetivo de facilitar a integração com a API da Teia
Card: http://api.saferedi.nteia.com/api/documentation/

## Dependências

* PHP >= 7.3

  #### Dependências utilizadas internamente
    * [Guzzle v6](https://docs.guzzlephp.org/en/6.5/)
    * [Collections v8.26](https://github.com/illuminate/collections)

## Estrutura do Projeto

```
|
├─ examples
│   ├─ functions                    # pasta contendo funções que podem ser reutilizadas entre exemplos
│   |    └─ EnumeratorCli.php       # simples CLI que permite selecionar qual enumerador deseja testar
│   ├─ 1-auth-login-password.php    # teste referente ao login com username/password
│   ├─ 2-auth-refresh-token.php     # teste referente ao login com refresh token
│   └─ ...
│
├─ phpdocker
│   ├─ nginx                            # pasta contendo arquivos de configurações do nginx
│   |    └─ nginx.conf                  # arquivo básico de configuração do nginx
│   └─ php-fpm                          # pasta contendo arquivos de configurações do php-fpm
|        ├─ Dockerfile                  # arquivo que inicia o ambiente Docker do PHP, com as extensões necessárias
│        └─ php-ini-overrides.ini       # arquivo que sobrescreve alguns parâmetros do PHP
│
├─ src
│   ├─ Data                             # pasta contendo arquivos de configurações do nginx
│   |    └─ Interfaces                  # arquivo básico de configuração do nginx
│   |    |     └─ DataInterface.php      # interface básica para os objetos de entrada de dados
│   |    └─ Requests
│   |       ├─ Autenticacao
│   |       |    └─ Credenciais.php        # DTO utilizado para envio no momento da autenticação com a Teia Card
│   |       ├─ AjusteCancelamento
│   |       |    └─ Ajuste.php             # DTO utilizado para envio de Ajustes (Cancelamentos)
│   |       ├─ Venda
│   |       |    ├─ Adquirente.php         # DTO utilizado para geração de dados de Adquirente no envio de vendas para a API
│   |       |    ├─ Cartao.php             # DTO utilizado para geração de dados de Cartão no envio de vendas para a API
│   |       |    └─ ...
│   |       ├─ Parcela
│   |       |    ├─ Parcela.php                # DTO utilizado para geração de dados de Parcela para consulta na API de parcelas consolidadas
│   |       |    └─ ParcelaNaoConsolidada.php  # DTO utilizado para geração de dados de Parcela Não Consolidadas para consulta na API.
│   ├─ DataTransferObject.php      # Classe abstrata para todos os DTOs
|   |
│   ├─ Endpoints                        # Classes com objetivo de enviar as requests para a API Teia Card. Sempre retornam Collection
│   |    ├─ Autenticacao
│   |    |    └─ Autenticacao.php       # Classe responsável por enviar as requests de autenticação
│   |    ├─ Enumerador
|   |    |    ├─ Adquirente.php         # Classe responsável por enviar as requests de enumerador de Adquirentes
|   |    |    ├─ Bandeira.php           # Classe responsável por enviar as requests de enumerador de Bandeiras
│   |    |    └─ ...
│   |    ├─ Remessa
│   |    |    └─ Venda.php              # Classe responsável por enviar as requests de Venda
│   |    ├─ Retorno                     # Responsavel por consultas diversas dentro da API do Teia Card
│   |    |    └─ AjusteCancelamento.php # Classe responsável por consultar os ajustes que foram enviados
│   |    |    └─ Empresa.php             # Classe responsável por consultar as empresas cadastradas para o login
│   |    |    └─ ...
│   |    └─ Endpoint.php                # Classe abstrata para todos os Endpoints
|   |
│   ├─ Exceptions                       # Contém todas as exceções que podem ser enviadas pelo SDK
|   |    ├─ TeiaCardBaseException.php   # Exceção base do SDK, todos os erros serão lançadas dela ou de uma exceção filha
|   |    └─ TeiaCardHttpException.php   # Exceção que indica que o erro veio de uma resposta da API e não do SDK em si
|   |
|   ├─ Anonymous.php                    # Helper utilizado para mapear as rotas aos endpoints
|   ├─ Client.php                       # Client de comunicação com a API, um wrapper do Guzzle
|   ├─ ResponseHandler.php              # Classe responsável por tratar as respostas, retornando sucesso ou disparando as exceções do SDK
|   └─ Routes.php                       # Arquivo que contém as rotas da API
|
├── .env                                # Arquivo obrigatório para o funcionamento do Docker/testes, contém as variáveis de ambiente
├── ...
├── composer.json                       # Contém as dependências necessárias do projeto
├── composer.lock                       # Contém as versões que devem ser instaladas
└── docker-compose.yml                  # Contém os objetos utilizados para subida do ambiente de testes
```

---

## Exemplos

A pasta `examples` contém exemplos de cada request que pode ser realizada e podem ser executadas via php no terminal:

`php examples/1-auth-login-password.php`

Foi criado também um ambiente Docker para facilitar a utilização dos exemplos, que pode ser utilizado da seguinte forma:

* Copiar o arquivo `.env.example` para `.env` e preencher as 4 informações necessárias (caso tenham sido alteradas).
* No diretório do projeto, executar `docker-compose up -d --build`
* Executar `docker-compose exec php-fpm bash` para entrar no container
* Acessar a pasta examples `cd examples`
* Executar o exemplo desejado. Exemplo:

    * Autenticar na Teia Card e salvar os tokens no Redis: `php examples/1-auth-login-password.php`
    * Listar Enumeradores: `php 3-enumerators.php`
        * Será apresentada uma lista de enumeradores para selecionar, inclusive uma opção para listar todos
    * Enviar uma nova Venda: `php 4-send-sale.php`

---

### Exemplos de utilização

#### Autenticação para obter tokens:

```php
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

```

---

#### Enviando dados de uma transação

```php
<?php

declare(strict_types = 1);

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
    $cartao->setNomeProprietario('Nome do Proprietario');
    $cartao->setNumeroTruncado('4111XXXXXXXX1111');

    echo "\n# Criando objeto Venda...\n";
    $venda = new Venda();
    $venda->setAdquirente($adquirente)
          ->setServicoTipo(1)
          ->setCartao($cartao)
          ->setCaixaNumero('1111')
          ->setPedidoNumero('4444444444')
          ->setTaxa(0.23)
          ->setNsu('42341')
          ->setAutorizacao('123AVC')
          ->setVendaDataHora(date('Y-m-d H:i:s', strtotime('now -3 hours')))
          ->setValorBruto(5.32)
          ->setPlano(2)
          ->setBandeira(1)
          ->setCaixaNomeOperador('Nome do Operador')
          ->setProgramaPromocional(false)
          ->setMeioCaptura(1)
          ->setVoucher(1)
          ->setGatewayPedidoId('3214')
          ->setChaveErp('CHAVE-123');

    echo "\n# Adicionando objeto Venda a Loja...\n";
    $loja->addVenda($venda);

    echo "\n# Adicionando objeto Loja a Empresa...\n";
    $empresa->addLoja($loja);

    echo "\n# Criando objeto Wrapper...\n";
    $wrapper = new Wrapper();
    echo "\n# Adicionando objeto Empresa ao Wrapper...\n";
    $wrapper->addEmpresa($empresa);

    echo "\n# Iniciando requisição de envio de Venda...\n";
    $response = $teiaCard->vendas()->send($wrapper);
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
```
