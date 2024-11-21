# Sistema de Gerenciamento de Tarefas (Laravel 11 + Vue.js)

Este projeto é um **Sistema de Gerenciamento de Tarefas** desenvolvido com **Laravel 11.x** no backend e **Vue.js** no frontend. O sistema permite o gerenciamento de usuários, criação, listagem, atualização e exclusão de tarefas, com autenticação de usuários e controle de acesso com base no papel de usuário (comum ou administrador).

## Funcionalidades

- **Cadastro de Usuários**: Os usuários podem se registrar no sistema e têm acesso ao painel de tarefas.
- **Autenticação**: O sistema suporta login e logout de usuários.
- **Gerenciamento de Tarefas**: Os usuários podem criar, listar, atualizar e excluir tarefas.
- **Controle de Acesso**: Apenas administradores podem criar novos administradores.

## Tecnologias Utilizadas

### Backend:
- **Laravel 11.x**: Framework PHP para o backend.
- **Inertia.js**: Para integrar o Vue.js com o Laravel de maneira simples e eficiente.
- **Laravel Breeze**: Scaffolding para autenticação de usuários.
  
### Frontend:
- **Vue.js**: Framework JavaScript para construção de interfaces reativas.
- **Vite**: Ferramenta de build moderna para desenvolvimento frontend.
- **Axios**: Para realizar requisições HTTP para o backend.

### Ferramentas de Desenvolvimento:
- **PHPUnit**: Framework para testes unitários em PHP.

## Passo a Passo para Executar o Projeto

### Após a execução do projeto você pode acessar dois usuários já cadastrados para testar cenários!
#### Usuário admin
- Email: igor@exata.com
- Senha: password

#### Usuário comum
- Email: leonardo@exata.com
- Senha: password

### Passo 1: Clonar o Repositório

Clone o repositório para o seu ambiente local:

```bash
git clone https://github.com/leonardosantosborges/task-management-system.git
cd task-management-system
```

### Passo 2: Instalar as Dependências
Instale as dependências do Laravel com o Composer:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

### Passo 3: Execute as migrações para criar o banco, tabelas e popular o banco:
```bash
php artisan migrate
```
#### Popule o banco:
```bash
php artisan db:seed
```

### Passo 4: Instale as dependências:

```bash
npm install
```

### Passo 5: Compile os assets do frontend:

```bash
npm run dev
```

### Passo 6: Executar o Servidor
```bash
php artisan serve
```

### Passo 7: Testes

```bash
./vendor/bin/phpunit --testsuite Unit
```
