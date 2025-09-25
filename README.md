# Sistema de Votação de Ideias - MVC

Sistema web desenvolvido seguindo o padrão arquitetural MVC (Model-View-Controller) para compartilhamento e gerenciamento de ideias.

## 🚀 Acesso ao Sistema
```
http://localhost/votacao-mvc/public/sistema.php
```

## 📋 Funcionalidades
- ✅ **Listagem de Ideias** - Visualizar todas as ideias cadastradas
- ✅ **Cadastro de Ideias** - Adicionar novas ideias ao sistema
- ✅ **Interface Responsiva** - Layout adaptável e profissional
- ✅ **Validação de Dados** - Tratamento adequado de formulários

## 📁 Estrutura do Projeto
```
votacao-mvc/
├── dao/                    # Data Access Objects
│   ├── IIdeiaDAO.php      # Interface do DAO
│   └── mysql/
│       └── IdeiaDAO.php   # Implementação MySQL
│
├── generic/               # Classes genéricas e utilitários
│   ├── Acao.php          # Sistema de ações
│   ├── Autoload.php      # Carregamento automático
│   ├── Controller.php    # Controlador genérico
│   ├── MysqlFactory.php  # Factory para conexão
│   └── MysqlSingleton.php # Singleton da conexão
│
├── controller/            # Controladores da aplicação
│   └── Ideia.php         # Controlador de ideias
│
├── service/               # Camada de serviços
│   └── IdeiaService.php  # Serviços de ideias
│
├── template/              # Sistema de templates
│   ├── ITemplate.php     # Interface de template
│   └── IdeiaTemp.php     # Template das ideias
│
├── public/                # Arquivos públicos (acessíveis via web)
│   ├── sistema.php       # 🎯 PONTO DE ENTRADA
│   └── ideia/
│       ├── listar.php    # View para listagem
│       └── form.php      # View para formulário
│
└── database.sql          # Script de criação do banco
```

## 🔗 URLs do Sistema
- **Página Inicial:** `sistema.php`
- **Lista de Ideias:** `sistema.php?param=ideia/lista`
- **Nova Ideia:** `sistema.php?param=ideia/formulario`
- **Cadastrar Ideia:** `sistema.php?param=ideia/inserir` (POST)

## ⚙️ Padrões de Projeto Implementados
- **📐 MVC (Model-View-Controller)** - Separação clara de responsabilidades
- **🗃️ DAO (Data Access Object)** - Encapsulamento do acesso aos dados
- **🏭 Factory Pattern** - Criação padronizada de objetos
- **👤 Singleton Pattern** - Instância única da conexão
- **📄 Template Method** - Sistema flexível de templates

## 🛠️ Tecnologias Utilizadas
- **PHP 7.4+** - Linguagem principal
- **MySQL** - Banco de dados
- **HTML5 + CSS3** - Interface do usuário
- **PDO** - Acesso ao banco de dados

## 📦 Instalação e Configuração

### 1. Requisitos
- XAMPP (Apache + MySQL + PHP)
- Navegador web

### 2. Configuração do Banco
```sql
-- Executar no phpMyAdmin ou MySQL
CREATE DATABASE sistema_votacao;
-- Importar o arquivo database.sql
```

### 3. Configuração da Conexão
Verificar as configurações em `generic/MysqlSingleton.php`:
```php
private $usuario = 'root';
private $senha = '';
private $dsn = 'mysql:host=localhost;dbname=sistema_votacao;charset=utf8';
```

### 4. Executar o Sistema
1. Copiar projeto para `C:\xampp\htdocs\votacao-mvc`
2. Iniciar Apache e MySQL no XAMPP
3. Acessar: `http://localhost/votacao-mvc/public/sistema.php`

## 🎨 Características da Interface
- **Design Limpo** - Interface moderna e intuitiva
- **Responsividade** - Adaptável a diferentes tamanhos de tela
- **Feedback Visual** - Hover effects e transições suaves
- **UX Otimizada** - Navegação clara e objetiva

## 📚 Arquitetura MVC

### Model (DAO + Service)
- **IdeiaDAO**: Operações de banco de dados
- **IdeiaService**: Regras de negócio

### View (Templates + Views)
- **Templates**: Estrutura HTML comum
- **Views**: Conteúdo específico de cada página

### Controller
- **Controller genérico**: Roteamento de requisições
- **IdeiaController**: Lógica específica de ideias

---

*Sistema desenvolvido seguindo boas práticas de desenvolvimento web e padrões de projeto consolidados.*