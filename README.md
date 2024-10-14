# Marketplace Connector

## Requisitos

- [Docker](https://docs.docker.com/install/)  
- [Docker compose 2.x](https://docs.docker.com/compose/install/#prerequisites) 
- [Composer](https://getcomposer.org/)  
- [PHP 8.3](https://www.php.net/releases/8.3/en.php)
- [Sentry](https://sentry.io/welcome/)

## Descrição do projeto
O Marketplace Connector é um sistema que integra a API de um marketplace com a de um HUB, facilitando a importação de anúncios. 
O projeto segue os princípios da Clean Architecture, assegurando a separação clara entre as camadas, o que torna o sistema mais fácil de manter e escalável.
O design pattern State é utilizado para gerenciar as transições de estado dos anúncios durante a importação e exportação, enquanto eventos e listeners organizam a execução dos jobs, mantendo os fluxos desacoplados e expansíveis.


## Observalidade

- [Telescope](http://localhost:8000/telescope) : Acesse o Telescope para monitorar suas requisições e variáveis de ambiente
- [Horizon](http://localhost:8000/horizon) : Use o Horizon para visualizar e gerenciar suas filas de trabalho.
- [Sentry](https://sentry.io/welcome/) : Para integrar o Sentry, siga os passos abaixo:

    Abra o arquivo `.env` e preencha o campo `SENTRY_LARAVEL_DSN` com seu DSN do Sentry:
    ```bash
    SENTRY_LARAVEL_DSN=your_sentry_dsn_here
    ```

## Postman - Rotas
- [Postman](https://www.postman.com/docking-module-cosmologist-72562827/marketplace-connector/overview) : Acesse o postman localmente para testar os endpoints

## Iniciando o projeto

Clonar o repositório

```bash
git clone git@github.com:GuilhermeYamasaki/marketplace-connector-api.git
```

Entrar na pasta

```bash
cd marketplace-connector-api
```

Baixar dependencias do Composer

```bash
composer install
```

Copiar .env 

```bash
cp .env.example .env
```

Adicionar alias do Sail

```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Construir container

```bash
sail up -d
```

Baixar dependencias do NPM

```bash
sail npm i
```

Gerar chave criptografada

```bash
sail artisan key:generate
```

Criar banco de dados

```bash
sail artisan migrate
```

Abrir um terminal e deixar executando

```bash
sail artisan horizon
```

