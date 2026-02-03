# TechFlow Solutions - Landing Page

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)
![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![Sass](https://img.shields.io/badge/Sass-CC6699?logo=sass&logoColor=white)

Landing page moderna e responsiva para a TechFlow Solutions, desenvolvida com HTML5, CSS3 (Sass), JavaScript puro, PHP e MySQL.

## Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Funcionalidades](#funcionalidades)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Compilação do Sass](#compilação-do-sass)
- [Configuração do Banco de Dados](#configuração-do-banco-de-dados)
- [Uso](#uso)
- [Boas Práticas Implementadas](#boas-práticas-implementadas)
- [Performance](#performance)
- [Compatibilidade](#compatibilidade)
- [Licença](#licença)

## Sobre o Projeto

Este projeto foi desenvolvido como uma landing page completa e funcional para a TechFlow Solutions, uma empresa fictícia de consultoria em transformação digital. O projeto demonstra habilidades em:

- **Front-end**: HTML5 semântico, CSS3 moderno com Sass, JavaScript vanilla
- **Back-end**: PHP orientado a boas práticas, PDO para banco de dados
- **Banco de Dados**: MySQL com estrutura normalizada
- **UX/UI**: Design responsivo, animações suaves, acessibilidade
- **Performance**: Otimizações de carregamento, debouncing, lazy loading
- **Segurança**: Validação de dados, proteção contra XSS e SQL Injection

## Tecnologias Utilizadas

### Front-end
- **HTML5** - Estrutura semântica e acessível
- **CSS3** - Estilização moderna com Flexbox e Grid
- **Sass (SCSS)** - Pré-processador CSS com variáveis, mixins e estrutura modular
- **JavaScript (ES6+)** - Funcionalidades interativas sem dependências externas

### Back-end
- **PHP 7.4+** - Processamento do formulário e lógica de negócios
- **PDO** - Camada de abstração para banco de dados com prepared statements

### Banco de Dados
- **MySQL 5.7+** - Armazenamento persistente de dados

### Fontes
- **Google Fonts** - Inter e Poppins

## Funcionalidades

### Formulário de Contato
- Validação em tempo real (client-side)
- Validação no servidor (server-side)
- Máscara de telefone automática
- Mensagens de erro específicas por campo
- Feedback visual de sucesso/erro
- Proteção contra XSS e SQL Injection
- Sanitização de dados

### Animações e Interatividade
- Animações CSS suaves e performáticas
- Scroll animations (fade in on scroll)
- Accordion FAQ interativo
- Smooth scroll para âncoras
- Efeitos hover nos cards e botões
- Header com shadow dinâmico no scroll

### Design Responsivo
- Mobile-first approach
- Breakpoints para tablets e desktops
- Grid system flexível
- Imagens responsivas
- Tipografia fluida

### Performance
- Debouncing em eventos de scroll
- CSS otimizado e modular
- JavaScript vanilla (sem frameworks pesados)
- Lazy loading ready
- Fontes otimizadas

### Acessibilidade
- HTML semântico
- ARIA labels
- Contraste adequado
- Navegação por teclado
- Focus states visíveis

## Estrutura do Projeto

```
teste-ellos/
│
├── index.php                 # Página principal
│
├── config/
│   └── database.php          # Configuração do banco de dados
│
├── api/
│   └── submit-form.php       # API para processar formulário
│
├── assets/
│   ├── css/
│   │   ├── style.css         # CSS compilado (gerado pelo Sass)
│   │   └── style.min.css     # CSS minificado (opcional)
│   │
│   ├── scss/
│   │   ├── style.scss        # Arquivo principal Sass
│   │   ├── _variables.scss   # Variáveis (cores, fontes, etc.)
│   │   ├── _mixins.scss      # Mixins reutilizáveis
│   │   ├── _base.scss        # Estilos base e reset
│   │   ├── _header.scss      # Estilos do header
│   │   └── _sections.scss    # Estilos das seções
│   │
│   ├── js/
│   │   └── main.js           # JavaScript principal
│   │
│   └── images/
│       └── (suas imagens aqui)
│
├── database/
│   └── schema.sql            # Schema do banco de dados
│
├── .gitignore                # Arquivos ignorados pelo Git
└── README.md                 # Este arquivo
```

## Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **Servidor Web**: Apache 2.4+ ou Nginx
- **PHP**: 7.4 ou superior
- **MySQL**: 5.7 ou superior (ou MariaDB 10.2+)
- **Sass**: Para compilar os arquivos SCSS (opcional, mas recomendado)
- **Navegador moderno**: Chrome, Firefox, Safari ou Edge

### Instalação do Sass (Opcional)

Existem várias formas de instalar o Sass. Escolha uma:

**Via npm (Node.js):**
```bash
npm install -g sass
```

**Via Chocolatey (Windows):**
```bash
choco install sass
```

**Via Homebrew (macOS):**
```bash
brew install sass/sass/sass
```

## Instalação

### 1. Clone ou baixe o projeto

```bash
# Se estiver usando Git
git clone https://github.com/seu-usuario/techflow-landing.git

# Ou baixe o ZIP e extraia na pasta do seu servidor web
```

### 2. Mova para a pasta do servidor web

**XAMPP (Windows):**
```bash
C:\xampp\htdocs\techflow-landing
```

**WAMP (Windows):**
```bash
C:\wamp64\www\techflow-landing
```

**MAMP (macOS):**
```bash
/Applications/MAMP/htdocs/techflow-landing
```

**Linux (Apache):**
```bash
/var/www/html/techflow-landing
```

### 3. Configure as permissões (Linux/macOS)

```bash
sudo chmod -R 755 /var/www/html/techflow-landing
sudo chown -R www-data:www-data /var/www/html/techflow-landing
```

## Compilação do Sass

### Opção 1: Compilação Manual (Recomendado para desenvolvimento)

Navegue até a pasta do projeto e execute:

```bash
# Compilação única
sass assets/scss/style.scss assets/css/style.css

# Modo watch (recompila automaticamente ao salvar)
sass --watch assets/scss:assets/css

# Compilação minificada para produção
sass assets/scss/style.scss assets/css/style.min.css --style=compressed
```

### Opção 2: Usar o CSS já fornecido

Se você não quiser compilar o Sass, pode usar ferramentas online ou solicitar o CSS compilado.

**Ferramentas online:**
- [SassMe](https://sass-lang.com/playground)
- [CodePen](https://codepen.io/)

### Opção 3: Script de compilação automático

Crie um arquivo `compile-sass.sh` (Linux/macOS) ou `compile-sass.bat` (Windows):

**Linux/macOS:**
```bash
#!/bin/bash
sass --watch assets/scss:assets/css --style=compressed
```

**Windows:**
```batch
@echo off
sass --watch assets/scss:assets/css --style=compressed
```

Execute:
```bash
# Linux/macOS
chmod +x compile-sass.sh
./compile-sass.sh

# Windows
compile-sass.bat
```

## Configuração do Banco de Dados

### 1. Criar o banco de dados

Acesse o phpMyAdmin ou seu cliente MySQL favorito e execute o arquivo SQL:

**Via phpMyAdmin:**
1. Acesse: `http://localhost/phpmyadmin`
2. Clique em "SQL"
3. Cole o conteúdo de `database/schema.sql`
4. Clique em "Executar"

**Via linha de comando:**
```bash
mysql -u root -p < database/schema.sql
```

### 2. Configurar credenciais

Edite o arquivo `config/database.php` e ajuste as credenciais:

```php
define('DB_HOST', 'localhost');        // Host do banco
define('DB_NAME', 'techflow_landing'); // Nome do banco
define('DB_USER', 'root');             // Usuário
define('DB_PASS', '');                 // Senha (vazio no XAMPP)
```

### 3. Testar a conexão

Crie um arquivo temporário `test-db.php` na raiz:

```php
<?php
require_once 'config/database.php';

if (testDatabaseConnection()) {
    echo "Conexão com banco de dados bem-sucedida!";
} else {
    echo "Falha ao conectar com o banco de dados.";
}
?>
```

Acesse: `http://localhost/techflow-landing/test-db.php`

**Importante:** Delete o arquivo `test-db.php` após o teste!

## Uso

### Acessar a aplicação

1. Inicie seu servidor web (Apache/MySQL)
2. Acesse no navegador: `http://localhost/techflow-landing`

### Testar o formulário

1. Preencha todos os campos obrigatórios:
   - Nome (mínimo 3 caracteres)
   - E-mail (formato válido)
   - Telefone (formato: (XX) XXXXX-XXXX)
   - Mensagem (mínimo 10 caracteres)

2. Clique em "Solicitar Consultoria"

3. Se tudo estiver correto, você verá:
   - Mensagem de sucesso
   - Os dados serão salvos no banco
   - O formulário será resetado

### Visualizar dados enviados

Acesse o banco de dados via phpMyAdmin:

```sql
SELECT * FROM contacts ORDER BY created_at DESC;
```

## Boas Práticas Implementadas

### Código Organizado
- Estrutura modular com separação de responsabilidades
- Sass organizado em arquivos parciais (`_variables`, `_mixins`, etc.)
- JavaScript com funções bem documentadas
- PHP com separação entre config, API e apresentação

### Segurança
- Prepared statements (PDO) contra SQL Injection
- Sanitização de inputs com `htmlspecialchars()`
- Validação server-side obrigatória
- Headers de segurança configurados
- Error logging sem exposição de detalhes sensíveis

### Performance
- CSS compilado e otimizado
- Debouncing em eventos frequentes (scroll)
- JavaScript vanilla (sem jQuery ou frameworks)
- Lazy loading ready para imagens
- Fontes com preconnect

### Documentação
- Código comentado
- README completo e detalhado
- Schema SQL documentado
- Funções PHP com DocBlocks

### Responsividade
- Mobile-first CSS
- Breakpoints bem definidos
- Grid system flexível
- Imagens responsivas

## Performance

### Lighthouse Score (Estimado)
- **Performance**: 90+
- **Acessibilidade**: 95+
- **Boas Práticas**: 100
- **SEO**: 90+

### Otimizações Implementadas
- Debouncing em scroll events
- CSS modular e otimizado
- JavaScript vanilla (zero dependencies)
- Lazy loading ready
- Fontes otimizadas com preconnect
- Prepared statements no PHP

## Compatibilidade

### Navegadores Suportados
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Opera 75+

### Dispositivos
- Desktop (1920px+)
- Laptop (1280px - 1920px)
- Tablet (768px - 1024px)
- Mobile (320px - 768px)

## Troubleshooting

### Problema: Sass não compila

**Solução:**
```bash
# Verifique se o Sass está instalado
sass --version

# Reinstale se necessário
npm install -g sass
```

### Problema: Erro de conexão com banco de dados

**Solução:**
1. Verifique se o MySQL está rodando
2. Confirme as credenciais em `config/database.php`
3. Verifique se o banco `techflow_landing` existe
4. Execute o `schema.sql` novamente

### Problema: Formulário não envia

**Solução:**
1. Abra o Console do navegador (F12)
2. Verifique erros JavaScript
3. Verifique se o arquivo `api/submit-form.php` existe
4. Confirme que o PHP está funcionando (`<?php phpinfo(); ?>`)

### Problema: CSS não está sendo aplicado

**Solução:**
1. Compile o Sass: `sass assets/scss/style.scss assets/css/style.css`
2. Verifique se `assets/css/style.css` existe
3. Limpe o cache do navegador (Ctrl + Shift + R)
4. Verifique o caminho no `<link>` do `index.php`

## Próximos Passos (Melhorias Futuras)

- [ ] Adicionar testes automatizados (PHPUnit)
- [ ] Implementar sistema de e-mail (PHPMailer)
- [ ] Adicionar Google reCAPTCHA
- [ ] Criar painel administrativo
- [ ] Adicionar mais animações
- [ ] Implementar dark mode
- [ ] Adicionar i18n (internacionalização)

## Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

---

## Agradecimentos

Desenvolvido para demonstração de habilidades em desenvolvimento web full-stack.

**Tecnologias utilizadas:**
- HTML5, CSS3, JavaScript, PHP, MySQL
- Sass para pré-processamento CSS
- PDO para segurança no banco de dados
- Design inspirado em tendências modernas de UI/UX

---

**TechFlow Solutions** - Transformando o futuro digital
