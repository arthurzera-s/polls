# Enquetes

**Este é um projeto de enquetes onde os usuários podem criar e votar em enquetes. O objetivo é permitir a interação entre os usuários e coletar opiniões e feedbacks.**

## Funcionalidades
O projeto inclui as seguintes funcionalidades:

- Os usuários podem criar novas enquetes
- Os usuários podem votar em enquetes existentes
- Os usuários podem ver as estatísticas das enquetes
- Os usuários podem editar as enquetes
- Os usuários podem excluir enquetes

## Tecnologias utilizadas
O projeto é desenvolvido utilizando as seguintes tecnologias:

- Laravel
- Vue.js
- Bootstrap
- MySQL

## Pré-requisitos
Antes de iniciar, é necessário ter as seguintes ferramentas instaladas em seu ambiente de desenvolvimento:

- Git: para clonar o repositório
- Composer: para instalar as dependências do Laravel
- Node.js: para instalar as dependências do Vue.js
- MySQL: para criar o banco de dados e tabelas necessárias

## Instalação
1. Clone este repositório para sua máquina local usando o comando `git clone`.
2. Navegue até o diretório do projeto e execute `composer install` para instalar as dependências do PHP.
3. Execute `npm install` para instalar as dependências do Vue.js.
4. Renomeie o arquivo `.env.exampl`e para `.env` e configure as variáveis de ambiente de acordo com o seu ambiente.
5. Execute `php artisan key:generate` para gerar a chave da aplicação.
6. Execute `php artisan migrate` para executar as migrações do banco de dados.
7. Execute `php artisan db:seed` para popular o banco de dados com dados de exemplo (opcional).

## Uso
1. Para iniciar a aplicação, execute `php artisan serve` e acesse http://localhost:8000 no seu navegador.
Se estiver em ambiente de desenvolvimento é recomendado utilizar `npm run watch` para compilar arquivos CSS, JavaScript e outras coisas à medida que você faz alterações no código, o que ajuda a acelerar o processo de desenvolvimento, pois você não precisa executar os comandos manualmente toda vez que fizer uma alteração.

### Bom uso! Sempre que puder estarei melhorando o projeto! :D
