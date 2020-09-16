<h1 align="center">Aplicação REST API LARAVEL e autenticação JWT  - Gerenciamento de Faturas</h1>

<p align="center">
 <a href="#computer-sobre">Sobre</a> •
 <a href="#pré-requisitos">Pré-requisitos</a> •
 <a href="#executar">Executar</a> •
 <a href="#hammer-endpoint-user">Endpoint User</a> •
 <a href="#hammer-endpoint-invoice">Endpoint Invoice</a> •
 <a href="#hammer-lecnologias">Tecnologias</a> •
 <a href="#autor">Autor</a> •
 <a href="#entre-em-contato">Entre em Contato</a>
 </p>

---
### :computer: Sobre

Aplicação REST API Lavavel com autenticação JWT (JSON Web Token), desenvolvida para gerenciamento de faturas, contemplando entidades USER e INVOICE. 

---
### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
- [x] [Git](https://git-scm.com/)
- [x] [Composer](https://getcomposer.org/)
- [x] PHP 7.2.5 ou superior [PHP](https://www.w3schools.com/php/php_install.asp)
- [x] Editor de código como [VSCode](https://code.visualstudio.com/)
---

### Executar
```bash
# Clone este repositório
$ git clone <https://github.com/lfboaventura/Rest-Api-Laravel-JWT.git>

# Acesse a pasta do projeto no terminal/cmd
$ cd Rest-Api-Laravel-JWT

# Instale as dependências
$ composer install

# Criar banco "database.sqlite" na pasta database

# Alterar arquivo .env banco, comentar\apagar variáveis 'DB_DATABASE=', 'DB_USERNAME' e 'DB_PASSWORD'
DB_CONNECTION=sqlite

# Atualizando APP_KEY e JWT_SECRET
$ php artisan key:generate
$ php artisan jwt:secret

# Rodando migrations
$ php artisan migrate

# Execute a aplicação
$ php artisan serve
```

> ⚠️ O servidor iniciará na porta:8000 - Acesse <http://localhost:8000>

---

### :hammer: **Endpoint User**
```bash

# post: Registro, atributos obrigatórios: name, email, password, password_confirmation.
/api/auth/register

# post: Login, atributos obrigatórios: email e password. 
# Retorno: access_token, "token_type": "bearer" e "expires_in": 3600.
/api/auth/login

# post: Renovação token.
/api/auth/refresh

# get: Profile.
/api/auth/profile

# post: Logout.
/api/auth/logout

```
---

### :hammer: **Endpoint Invoice** (Usuário logado)
```bash

# post: Registro, atributos obrigatórios: due[date], status['Paga','Aberta','Atrasada'].
/api/auth/invoice

# get: Consulta invoices.
/api/auth/invoices

# get: Consulta invoice por url.
/api/auth/invoice/byUrl/{url}

# get: Consulta invoice por id.
/api/auth/invoice/byUrl/{idl}

# get: Deleta invoice por id.
/api/auth/invoice/delete/{idl}

# post: Atualiza invoice por id.
/api/auth/invoice/{id}

```

---

### :hammer: **Tecnologias**

As seguintes ferramentas foram utilizadas na construção do projeto:

- [SQLite](https://www.sqlite.org)
- [Laravel](https://laravel.com/)
- [JWT](https://jwt.io/)
- [Postman](https://www.postman.com/)

---

### **Autor**

<a href="https://github.com/lfboaventura">
 <img style="border-radius: 50%;" src="https://avatars3.githubusercontent.com/u/64990956?s=460&u=51e4d8022ccf5165d050d44306c132d65293a196&v=4" width="100px;" alt="Perfil Lúcio Flávio Boaventura"/>
 <br />
 <sub><b>Lúcio Flávio Boaventura</b></sub></a> <a href="https://github.com/lfboaventura" title="Lúcio Flávio Boaventura"></a>

---

### **Entre em Contato**

- [Linkidin](https://www.linkedin.com/in/lucio-flavio-boaventura-8b429921/)
- [Resume](https://github.com/lfboaventura/resume)