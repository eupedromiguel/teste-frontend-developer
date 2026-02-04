# TechFlow Solutions - Landing Page

Landing page responsiva para a TechFlow Solutions, desenvolvida com HTML5, CSS3 (Sass), JavaScript, PHP e MySQL.

## Tecnologias Utilizadas

- HTML5, CSS3 (Sass), JavaScript (Vanilla)
- PHP 7.4+ com PDO
- MySQL 5.7+

## Começando

### Passo 1: Verificar Status do MySQL

Acesse [test-mysql.php](test-mysql.php) para testar a conexão com MySQL:

```
http://localhost/teste-ellos/test-mysql.php
```

Vai mostrar se o MySQL está rodando e se o banco `techflow_landing` já existe.

### Passo 2: Instalar o Banco de Dados

Se o banco não existir, rode o [install-simples.php](install-simples.php):

```
http://localhost/teste-ellos/install-simples.php
```

Cria o banco, a tabela `contacts` e adiciona 4 contatos de exemplo.

### Passo 3: Debug (se der problema)

Se algo der errado, use o [debug-install.php](debug-install.php):

```
http://localhost/teste-ellos/debug-install.php
```

Mostra logs detalhados de cada etapa para identificar o problema.

### Passo 4: Conferir no PhpMyAdmin

Depois da instalação, confira no PhpMyAdmin:

```
http://localhost/phpmyadmin
```

Confira se o banco `techflow_landing` e a tabela `contacts` foram criados.

### Passo 5: Acessar a Landing Page

Pronto! Agora é só acessar:

```
http://localhost/teste-ellos/index.php
```

## Funcionalidades Implementadas

- Formulário de contato com validação client-side e server-side
- Máscara de telefone automática
- Accordion FAQ interativo
- Animações no scroll
- Design responsivo (mobile-first)
- Proteção contra XSS e SQL Injection (prepared statements)

## Estrutura do Projeto

```
teste-ellos/
├── index.php                 # Landing page principal
├── test-mysql.php            # Teste de conexão com MySQL
├── install-simples.php       # Instalador do banco de dados
├── debug-install.php         # Instalador com logs de debug
│
├── config/
│   └── database.php          # Configuração do banco
│
├── api/
│   └── submit-form.php       # Processa o formulário
│
├── assets/
│   ├── css/
│   │   └── style.css         # CSS compilado do Sass
│   ├── scss/
│   │   └── ...               # Arquivos Sass
│   └── js/
│       └── main.js           # JavaScript principal
│
└── database/
    └── schema.sql            # Schema do banco (manual)
```

## Compilar Sass (Opcional)

O CSS já está compilado. Se quiser modificar os estilos:

```bash
sass --watch assets/scss:assets/css
```

## Configuração do Banco

Credenciais padrão no [config/database.php](config/database.php):

```
Host: localhost
User: root
Pass: (vazio)
DB: techflow_landing
```

Se usar credenciais diferentes, edite o arquivo antes de rodar o instalador.
