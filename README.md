# Sistema de Votação de Ideias - MVC# Sistema de Votação de Ideias



Sistema web desenvolvido seguindo o padrão arquitetural MVC (Model-View-Controller) para compartilhamento e gerenciamento de ideias.# Sistema de Votação de Ideias - MVC



## 🚀 Acesso ao SistemaSistema web desenvolvido em PHP utilizando o padrão arquitetural MVC (Model-View-Controller) para gerenciamento e votação de ideias.

```

http://localhost/votacao-mvc/public/sistema.php## 🚀 Como Acessar

```

### Opção 1: Acesso pela raiz (Recomendado)

## 📋 Funcionalidades```

- ✅ **Listagem de Ideias** - Visualizar todas as ideias cadastradashttp://localhost/votacao-mvc/

- ✅ **Cadastro de Ideias** - Adicionar novas ideias ao sistema```

- ✅ **Interface Responsiva** - Layout adaptável e profissionalO sistema automaticamente redirecionará para a pasta `public`.

- ✅ **Validação de Dados** - Tratamento adequado de formulários

### Opção 2: Acesso direto ao public

## 📁 Estrutura do Projeto```

```http://localhost/votacao-mvc/public/

votacao-mvc/```

├── dao/                    # Data Access Objects

│   ├── IIdeiaDAO.php      # Interface do DAO## 📁 Estrutura do Projeto

│   └── mysql/

│       └── IdeiaDAO.php   # Implementação MySQL```

│votacao-mvc/

├── generic/               # Classes genéricas e utilitários├── index.php              # 🎯 PONTO DE ENTRADA PRINCIPAL

│   ├── Acao.php          # Sistema de ações├── .htaccess              # Segurança da raiz

│   ├── Autoload.php      # Carregamento automático├── database.sql           # Script de criação do banco

│   ├── Controller.php    # Controlador genérico├── README.md             # Esta documentação

│   ├── MysqlFactory.php  # Factory para conexão├── INSTALACAO.md         # Guia de instalação

│   └── MysqlSingleton.php # Singleton da conexão│

│├── config/               # ⚙️ Configurações

├── controller/            # Controladores da aplicação│   └── Database.php      # Conexão com banco de dados

│   └── Ideia.php         # Controlador de ideias│

│├── models/               # 📊 Modelos (Data Access Objects)

├── service/               # Camada de serviços│   ├── UsuarioDAO.php    # Operações de usuários

│   └── IdeiaService.php  # Serviços de ideias│   ├── IdeiaDAO.php      # Operações de ideias

││   └── VotoDAO.php       # Operações de votos

├── template/              # Sistema de templates│

│   ├── ITemplate.php     # Interface de template├── services/             # 🔧 Serviços (Regras de Negócio)

│   └── IdeiaTemp.php     # Template das ideias│   ├── UsuarioService.php # Lógica de usuários

││   ├── IdeiaService.php  # Lógica de ideias

├── public/                # Arquivos públicos (acessíveis via web)│   └── VotoService.php   # Lógica de votação

│   ├── sistema.php       # 🎯 PONTO DE ENTRADA│

│   └── ideia/├── controllers/          # 🎮 Controladores

│       ├── listar.php    # View para listagem│   ├── UsuarioController.php # Controle de usuários

│       └── form.php      # View para formulário│   ├── IdeiaController.php   # Controle de ideias

││   └── VotoController.php    # Controle de votos

└── database.sql          # Script de criação do banco│

```├── views/                # 🎨 Templates

│   ├── layout.php        # Layout base

## 🔗 URLs do Sistema│   ├── usuarios/         # Telas de usuário

- **Página Inicial:** `sistema.php`│   └── ideias/           # Telas de ideias

- **Lista de Ideias:** `sistema.php?param=ideia/lista`│

- **Nova Ideia:** `sistema.php?param=ideia/formulario`└── public/               # 🌐 PASTA PÚBLICA (Acessível via web)

- **Cadastrar Ideia:** `sistema.php?param=ideia/inserir` (POST)    ├── index.php         # Aplicação principal

    ├── .htaccess         # Configurações de URL

## ⚙️ Padrões de Projeto Implementados    ├── css/              # Estilos

- **📐 MVC (Model-View-Controller)** - Separação clara de responsabilidades    ├── js/               # JavaScript

- **🗃️ DAO (Data Access Object)** - Encapsulamento do acesso aos dados    └── diagnostico.php   # Ferramenta de diagnóstico

- **🏭 Factory Pattern** - Criação padronizada de objetos```

- **👤 Singleton Pattern** - Instância única da conexão

- **📄 Template Method** - Sistema flexível de templates## 🔒 Segurança



## 🛠️ Tecnologias Utilizadas- ✅ Apenas a pasta `public` e o `index.php` da raiz são acessíveis via web

- **PHP 7.4+** - Linguagem principal- ✅ Todas as outras pastas são protegidas por `.htaccess`

- **MySQL** - Banco de dados- ✅ URLs amigáveis com mod_rewrite

- **HTML5 + CSS3** - Interface do usuário- ✅ Proteção contra acesso direto aos arquivos PHP

- **PDO** - Acesso ao banco de dados

## 🎯 Pontos de Entrada

## 📦 Instalação e Configuração

1. **`/index.php`** - Ponto de entrada principal (redireciona para public)

### 1. Requisitos2. **`/public/index.php`** - Aplicação MVC principal

- XAMPP (Apache + MySQL + PHP)3. **`/public/diagnostico.php`** - Ferramenta de diagnóstico do sistema

- Navegador web

## 🎯 Funcionalidades

### 2. Configuração do Banco

```sql### Para Usuários

-- Executar no phpMyAdmin ou MySQL- **Cadastro e Login**: Sistema de autenticação completo

CREATE DATABASE sistema_votacao;- **Gerenciar Ideias**: Criar, editar, visualizar e excluir suas próprias ideias

-- Importar o arquivo database.sql- **Sistema de Votação**: Votar e remover votos em ideias de outros usuários

```- **Perfil Pessoal**: Visualizar e editar informações do perfil

- **Minhas Atividades**: Acompanhar suas ideias e votos dados

### 3. Configuração da Conexão

Verificar as configurações em `generic/MysqlSingleton.php`:### Características Técnicas

```php- **Arquitetura MVC**: Organização clara e modular do código

private $usuario = 'root';- **Padrão DAO**: Camada de acesso aos dados bem estruturada

private $senha = '';- **Services**: Regras de negócio encapsuladas

private $dsn = 'mysql:host=localhost;dbname=sistema_votacao;charset=utf8';- **Interface Responsiva**: Design moderno com Bootstrap 5

```- **AJAX**: Votação em tempo real sem recarregar a página

- **Validações**: Cliente e servidor para garantir integridade dos dados

### 4. Executar o Sistema

1. Copiar projeto para `C:\xampp\htdocs\votacao-mvc`## 🚀 Instalação e Configuração

2. Iniciar Apache e MySQL no XAMPP

3. Acessar: `http://localhost/votacao-mvc/public/sistema.php`### Pré-requisitos

- PHP 7.4 ou superior

## 🎨 Características da Interface- MySQL 5.7 ou superior

- **Design Limpo** - Interface moderna e intuitiva- Servidor web (Apache/Nginx) ou PHP Built-in Server

- **Responsividade** - Adaptável a diferentes tamanhos de tela- Extensões PHP: PDO, PDO_MySQL

- **Feedback Visual** - Hover effects e transições suaves

- **UX Otimizada** - Navegação clara e objetiva### Passo 1: Clonar o Projeto

```bash

## 📚 Arquitetura MVCgit clone https://github.com/seu-usuario/votacao-mvc.git

cd votacao-mvc

### Model (DAO + Service)```

- **IdeiaDAO**: Operações de banco de dados

- **IdeiaService**: Regras de negócio### Passo 2: Configurar o Banco de Dados



### View (Templates + Views)1. Crie um banco de dados MySQL:

- **Templates**: Estrutura HTML comum```sql

- **Views**: Conteúdo específico de cada páginaCREATE DATABASE sistema_votacao CHARACTER SET utf8 COLLATE utf8_general_ci;

```

### Controller

- **Controller genérico**: Roteamento de requisições2. Execute o script SQL fornecido:

- **IdeiaController**: Lógica específica de ideias```bash

# Via linha de comando

---mysql -u root -p sistema_votacao < database.sql



*Sistema desenvolvido seguindo boas práticas de desenvolvimento web e padrões de projeto consolidados.*# Ou via phpMyAdmin (XAMPP)
# 1. Acesse http://localhost/phpmyadmin
# 2. Clique em "Importar"
# 3. Selecione o arquivo database.sql
# 4. Clique em "Executar"
```

3. Configure a conexão em `config/database.php`:
```php
private $host = 'localhost';      // Seu host MySQL
private $db_name = 'sistema_votacao'; // Nome do banco
private $username = 'root';       // Seu usuário MySQL
private $password = '';           // Sua senha MySQL
```

### Passo 3: Configurar o Servidor Web

#### Opção 1: XAMPP (Recomendado)
1. Baixe e instale o [XAMPP](https://www.apachefriends.org/pt_br/index.html)
2. Inicie o XAMPP Control Panel
3. Inicie os serviços **Apache** e **MySQL**
4. Copie a pasta do projeto para `C:\xampp\htdocs\votacao-mvc`
5. Acesse: `http://localhost/votacao-mvc/public`

#### Opção 2: Servidor PHP Built-in (Desenvolvimento)
```bash
cd public
php -S localhost:8000
```

#### Opção 3: Apache/Nginx
Configure o DocumentRoot para apontar para a pasta `public/`

### Passo 4: Acessar o Sistema
**Se usando XAMPP:** `http://localhost/votacao-mvc/public`
**Se usando PHP Built-in:** `http://localhost:8000`

## 📁 Estrutura do Projeto

```
votacao-mvc/
├── config/
│   └── database.php           # Configuração do banco
├── controllers/
│   ├── IdeiaController.php    # Controller das ideias
│   ├── UsuarioController.php  # Controller dos usuários
│   └── VotoController.php     # Controller dos votos
├── models/
│   ├── IdeiaDAO.php          # Data Access Object das ideias
│   ├── UsuarioDAO.php        # Data Access Object dos usuários
│   └── VotoDAO.php           # Data Access Object dos votos
├── services/
│   ├── IdeiaService.php      # Regras de negócio das ideias
│   ├── UsuarioService.php    # Regras de negócio dos usuários
│   └── VotoService.php       # Regras de negócio dos votos
├── views/
│   ├── ideias/               # Views das ideias
│   ├── usuarios/             # Views dos usuários
│   └── layout.php            # Layout principal
├── public/
│   ├── css/
│   │   └── style.css         # Estilos customizados
│   ├── js/
│   │   └── main.js           # JavaScript principal
│   └── index.php             # Ponto de entrada e roteamento
├── database.sql              # Script de criação do banco
└── README.md                 # Esta documentação
```

## 🎨 Padrões Utilizados

### MVC (Model-View-Controller)
- **Model**: Classes DAO para acesso aos dados
- **View**: Templates HTML para apresentação
- **Controller**: Lógica de controle e coordenação

### DAO (Data Access Object)
- Isolamento da lógica de acesso ao banco de dados
- Reutilização de código
- Facilita manutenção e testes

### Service
- Encapsulamento das regras de negócio
- Validações centralizadas
- Lógica complexa separada dos controllers

## 🔧 Como Usar

### 1. Cadastro de Usuário
1. Acesse a página inicial
2. Clique em "Cadastrar"
3. Preencha os dados solicitados
4. Faça login com suas credenciais

### 2. Criar uma Ideia
1. Faça login no sistema
2. Clique em "Nova Ideia"
3. Preencha título e descrição
4. Clique em "Compartilhar Ideia"

### 3. Votar em Ideias
1. Na página inicial, visualize as ideias disponíveis
2. Clique no botão de voto (coração) da ideia desejada
3. O voto é registrado em tempo real

### 4. Gerenciar suas Ideias
1. Acesse "Meu Perfil" → "Minhas Ideias"
2. Visualize, edite ou exclua suas ideias
3. Acompanhe os votos recebidos

## 🛠️ Funcionalidades CRUD

### Usuários
- **Create**: Cadastro de novos usuários
- **Read**: Visualização do perfil e listagem
- **Update**: Edição de dados pessoais
- **Delete**: (Pode ser implementado conforme necessário)

### Ideias
- **Create**: Criação de novas ideias
- **Read**: Listagem e visualização detalhada
- **Update**: Edição de ideias próprias
- **Delete**: Exclusão de ideias próprias

### Votos
- **Create**: Registrar voto em uma ideia
- **Read**: Listar votos dados e recebidos
- **Update**: Alternar voto (votar/remover voto)
- **Delete**: Remover voto de uma ideia

## 🔒 Segurança

- **Autenticação**: Sistema de login com sessões PHP
- **Autorização**: Usuários só podem editar/excluir suas próprias ideias
- **Validação**: Validações no cliente (JS) e servidor (PHP)
- **Sanitização**: Uso de `htmlspecialchars()` para prevenir XSS
- **SQL Injection**: Uso de prepared statements com PDO
- **CSRF**: Pode ser implementado com tokens para maior segurança

## 📊 Banco de Dados

### Tabela: usuarios
- `id`: Chave primária
- `nome`: Nome completo do usuário
- `email`: Email único
- `senha`: Senha criptografada com `password_hash()`
- `data_criacao`: Timestamp de criação

### Tabela: ideias
- `id`: Chave primária
- `titulo`: Título da ideia (máx. 150 caracteres)
- `descricao`: Descrição completa
- `usuario_id`: Chave estrangeira para usuários
- `data_criacao`: Timestamp de criação

### Tabela: votos
- `id`: Chave primária
- `usuario_id`: Chave estrangeira para usuários
- `ideia_id`: Chave estrangeira para ideias
- `data_voto`: Timestamp do voto
- **Constraint**: Único por (usuario_id, ideia_id)

## 🌐 URLs do Sistema

### URLs Amigáveis (com .htaccess)
- `/` - Página inicial
- `/login` - Login
- `/cadastro` - Cadastro
- `/perfil` - Perfil do usuário
- `/logout` - Sair do sistema
- `/nova-ideia` - Criar nova ideia
- `/minhas-ideias` - Minhas ideias
- `/meus-votos` - Meus votos
- `/ideia/visualizar/ID` - Ver ideia específica
- `/ideia/editar/ID` - Editar ideia
- `/ideia/excluir/ID` - Excluir ideia

### URLs Tradicionais (compatibilidade)
- `/?controller=usuario&action=cadastrar` - Cadastro
- `/?controller=usuario&action=login` - Login
- `/?controller=usuario&action=perfil` - Perfil do usuário
- `/?controller=usuario&action=minhasIdeias` - Minhas ideias
- `/?controller=usuario&action=meusVotos` - Meus votos
- `/?controller=ideia&action=criar` - Criar nova ideia
- `/?controller=ideia&action=visualizar&id=X` - Ver ideia
- `/?controller=ideia&action=editar&id=X` - Editar ideia
- `/?controller=ideia&action=excluir&id=X` - Excluir ideia

### Votos
- `/?controller=voto&action=alternar` - Votar/remover voto (AJAX)

## 🎯 Melhorias Futuras

- [ ] Sistema de comentários nas ideias
- [ ] Categorias para as ideias
- [ ] Busca e filtros avançados
- [ ] Sistema de notificações
- [ ] API REST para integração
- [ ] Testes automatizados
- [ ] Sistema de moderação
- [ ] Rankings e estatísticas avançadas

## 🤝 Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto é desenvolvido para fins educacionais como parte do curso de desenvolvimento web com PHP MVC.

## 👥 Autores

- **[Seu Nome]** - Desenvolvimento inicial
- **[Nome do Parceiro]** - Desenvolvimento em dupla

## 📞 Suporte

Para dúvidas ou problemas:
- Abra uma issue no GitHub
- Entre em contato via email

## 🔗 Links Úteis

- [Documentação PHP](https://www.php.net/docs.php)
- [Bootstrap 5](https://getbootstrap.com/docs/5.1/)
- [Padrão MVC](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
- [Padrão DAO](https://en.wikipedia.org/wiki/Data_access_object)

---

**Desenvolvido com ❤️ usando PHP MVC**