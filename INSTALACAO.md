# Sistema de Votação de Ideias - Configuração Rápida com XAMPP

## 🚀 Instruções de Instalação

### 1. Configurar XAMPP
1. Baixe e instale o [XAMPP](https://www.apachefriends.org/pt_br/index.html)
2. Abra o XAMPP Control Panel
3. Inicie os serviços **Apache** e **MySQL**

### 2. Configurar Projeto
1. Copie a pasta `votacao-mvc` para `C:\xampp\htdocs\`
2. O caminho final deve ser: `C:\xampp\htdocs\votacao-mvc\`

### 3. Configurar Banco de Dados

#### Opção A: Via phpMyAdmin (Mais Fácil)
1. Acesse: `http://localhost/phpmyadmin`
2. Clique em "Novo" para criar banco
3. Nome: `sistema_votacao`
4. Clique em "Importar" → Selecione `database.sql` → "Executar"

#### Opção B: Via Linha de Comando
```bash
mysql -u root -p < database.sql
```

### 4. Configurar Conexão (se necessário)
Edite `config/database.php` apenas se sua configuração MySQL for diferente:

```php
private $host = 'localhost';
private $db_name = 'sistema_votacao';
private $username = 'root';
private $password = ''; // Deixe vazio para XAMPP padrão
```

### 5. Acessar Sistema
Abra o navegador em: **http://localhost/votacao-mvc/public**

## 📋 Credenciais de Teste
O sistema já vem com usuários de exemplo:
- **Email:** joao@email.com | **Senha:** password
- **Email:** maria@email.com | **Senha:** password
- **Email:** pedro@email.com | **Senha:** password

## ✅ Funcionalidades Implementadas
- ✅ CRUD completo de Ideias
- ✅ CRUD completo de Usuários
- ✅ Sistema de Votação
- ✅ Autenticação e Sessões
- ✅ Interface Responsiva
- ✅ Validações Frontend e Backend
- ✅ Arquitetura MVC
- ✅ Padrões DAO e Service

## 📁 Estrutura MVC
```
├── models/ (DAO - Acesso aos dados)
├── views/ (Interface HTML)
├── controllers/ (Lógica de controle)
├── services/ (Regras de negócio)
├── config/ (Configurações)
└── public/ (Ponto de entrada)
```

## 🎯 Demonstração das Funcionalidades
1. **Cadastro/Login**: Sistema completo de autenticação
2. **Criar Ideia**: Formulário com validações
3. **Listar Ideias**: Página principal com todas as ideias
4. **Votar**: Sistema AJAX em tempo real
5. **Editar/Excluir**: Apenas o autor pode modificar suas ideias
6. **Perfil**: Área do usuário com suas atividades

## 📂 Estrutura no XAMPP
```
C:\xampp\htdocs\votacao-mvc\
├── config/
├── controllers/
├── models/
├── services/
├── views/
├── public/ ← Ponto de entrada
├── database.sql
└── README.md
```

**Sistema pronto para apresentação e avaliação!**