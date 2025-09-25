# Sistema de Votação de Ideias

Um sistema web completo desenvolvido em PHP usando o padrão de arquitetura MVC (Model-View-Controller) onde os usuários podem compartilhar ideias, votar nas suas favoritas e acompanhar as mais populares da comunidade.

## 🎯 Funcionalidades

### Para Usuários
- **Cadastro e Login**: Sistema de autenticação completo
- **Gerenciar Ideias**: Criar, editar, visualizar e excluir suas próprias ideias
- **Sistema de Votação**: Votar e remover votos em ideias de outros usuários
- **Perfil Pessoal**: Visualizar e editar informações do perfil
- **Minhas Atividades**: Acompanhar suas ideias e votos dados

### Características Técnicas
- **Arquitetura MVC**: Organização clara e modular do código
- **Padrão DAO**: Camada de acesso aos dados bem estruturada
- **Services**: Regras de negócio encapsuladas
- **Interface Responsiva**: Design moderno com Bootstrap 5
- **AJAX**: Votação em tempo real sem recarregar a página
- **Validações**: Cliente e servidor para garantir integridade dos dados

## 🚀 Instalação e Configuração

### Pré-requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx) ou PHP Built-in Server
- Extensões PHP: PDO, PDO_MySQL

### Passo 1: Clonar o Projeto
```bash
git clone https://github.com/seu-usuario/votacao-mvc.git
cd votacao-mvc
```

### Passo 2: Configurar o Banco de Dados

1. Crie um banco de dados MySQL:
```sql
CREATE DATABASE sistema_votacao CHARACTER SET utf8 COLLATE utf8_general_ci;
```

2. Execute o script SQL fornecido:
```bash
# Via linha de comando
mysql -u root -p sistema_votacao < database.sql

# Ou via phpMyAdmin (XAMPP)
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

### Usuários
- `/` - Página inicial
- `/?controller=usuario&action=cadastrar` - Cadastro
- `/?controller=usuario&action=login` - Login
- `/?controller=usuario&action=perfil` - Perfil do usuário
- `/?controller=usuario&action=minhasIdeias` - Minhas ideias
- `/?controller=usuario&action=meusVotos` - Meus votos

### Ideias
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