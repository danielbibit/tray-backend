# Desafio técnico Tray - Backend

# Aplicação online
A aplicação está disponível online, e pode ser acessada através dos links abaixo.
- UI - http://ui.tray.moraes.dev.br:5173
- API - http://api.tray.moraes.dev.br:8000

Login: admin@test.com
Senha: adminadmin


# Setup desenvolvimento
## Pré-requisitos
- Git
- Docker
- Docker-compose
- VSCode (opcional)

## Preparação de variáveis de ambiente
As variavéis de ambiente no arquivo de exemplo são suficientes para subir a aplicação
no ambiente de desenvolvimento.
Caso queira alterar as variáveis de ambiente, basta copiar o arquivo de exemplo e
alterar os valores.
```sh
# Prepara varaveis api
cd tray-backend
cp .env.example .env

# Prepara variaveis ui
cd ui
cp .env.example .env
```

## Executando a aplicação
### Desenvolvimento VSCode
O modo recomendado para desenvolvimento, é utilizando a ferramenta de Remote development do VSCode.
Tanto a API, quando a UI possuem arquivos de configuração para o VSCode,
que permitem executar a aplicação diretamente no container,
com todas as dependências e ferramentas necessárias instaladas.

Para isso, basta abrir o repositório no VSCode, e clicar no botão **"Reopen in Container"**,
que aparece no canto inferior esquerdo da tela.

### Docker-compose
Caso não queira utilizar o VSCode, é possível executar a aplicação utilizando o docker-compose.
Para isso, basta executar o comando abaixo na raiz do projeto.
```sh
docker-compose up -d
```

Caso execute a aplicação dessa forma, você pode acessar os containers utilizando o comando abaixo.
```sh
docker exec -it tray_api /bin/bash
docker exec -it tray_ui /bin/sh
```

Uma vez dentro do container, você pode executar os comandos abaixo para executar as aplicações.
```sh
# Executa a api
php artisan serve --host=0.0.0.0 --port=8000

# Executa a ui
npm run dev
```

Para executar os testes
```sh
php artisan test
```

## Setup laravel e migrations
A primeira vez que subir a aplicação, é necessário gerar a chave da aplicação,
e rodar as migrations.
Caso você esteja subindo a aplicação para desenvolvimento, deve também executar as seeds.

```sh
docker exec tray_api php artisan key:generate
docker exec tray_api php artisan migrate
docker exec tray_api php artisan db:seed
```

# Objetivos do desafio
Esse projeto foi um desafio técnico proposto pela Tray, onde o objetivo era criar uma API
para cadastro de vendedores e vendas, e uma aplicação para consumir essa API.

Os seguintes itens foram propostos:
## API
- [x] Cadastrar vendedores informando nome e e-mail;
- [x] Cadastrar venda, vendedor, valor e data;
- [x] Listar todos os vendedores;
- [x] Listar todas as vendas;
- [x] Listar todas as vendas por vendedor;

## Aplicação
- [x] Interagir com todos endpoints da API;
- [x] Enviar um e-mail para o vendedor ao final de cada dia.
- [x] Enviar um e-mail para o administrador do sistema contendo a soma de todas as vendas
- [x] Permitir que o administrador reenvie o e-mail de comissão a um determinado vendedor;

## Bônus
- [x] Autenticação API
- [x] Testes (Apenas unit tests para services)
- [ ] Implementar remoção e edição do vendedor
- [x] Implementar validação dos dados enviados

# Documentação API

## /login (POST)
Endpoint para gerar o token de autenticação.
Todas a chamadas para a API devem possuir um token do tipo *Bearer* no header *Authorization*

### Request Body
```json
{
    "email": "admin@test.com",
    "password": "adminadmin",
    "device_name": "SPA"
}
```

### Response
```json
{
    "token": "TOKEN_STRING_EXAMPLE"
}
```

## Endpoints disponíveis
- /seller (POST)
- /seller (GET)
- /seler/{id} (GET)
- /seler/{id}/sales (GET)

- /sale (POST)
- /sale (GET)

- /report/adminReport (POST)
- /report/sellerReport (POST)


# Notas de desenvolvimento
- Foi escolhido utilizar apenas um repositório para tanto para a API Laravel,
quanto para a SPA feita em VueJS.
Isso foi feito para facilitar a criação o ambiente de desenvolvimento.
Todos os commits feitos na SPA foram prefixados com **"ui: "** para facilitar a identificação.
- Não foi feito o uso de feature branches, por se tratar de de uma primeira versão,
e ter apenas um desenvolvedor.
- Apenas os métodos necessários para satisfazer os requesitos foram implementados.
- As imagens docker foram criadas pensando apenas para o ambiente de desenvolvimento.
Não sendo adequadas para ambientes de produção.
- Foi dada preferência para o uso de ferramentas e técnicas padrões do Laravel,
a fim e facilitar o desenvolvimento e manutenção do projeto.
- Com finalidade de desacoplar a aplicação do framework,
foi utilizado o padrão de repositórios para acesso aos dados,
e também a criação de uma camada de serviço para as regras negócio e validação.
- É necessário documentar os endpoints da API.
