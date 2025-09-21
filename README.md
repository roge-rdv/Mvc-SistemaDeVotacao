# Sistema de Votação de Ideias

Bem-vindo ao Sistema de Votação de Ideias! Esta é uma aplicação web simples, desenvolvida como um projeto de estudo para aplicar os conceitos do padrão de arquitetura MVC (Model-View-Controller) em PHP.

O objetivo da plataforma é permitir que uma comunidade de utilizadores possa sugerir novas ideias, visualizar as ideias de outros e votar nas suas favoritas, criando um ranking de popularidade.

## ✨ Funcionalidades

### Implementadas:
- Listagem de todas as ideias existentes no banco de dados.
- Interface visual para a submissão de novas ideias (formulário).
- Estrutura MVC organizada e escalável.
- Estilização moderna e responsiva utilizando Tailwind CSS.

### Planeadas:
- Sistema de registo e login de utilizadores.
- Funcionalidade de voto (incrementar/decrementar).
- Contagem e exibição do número de votos por ideia.
- Secção de comentários para cada ideia.
- Autenticação para garantir que apenas utilizadores logados possam votar ou comentar.

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP 8+
- **Banco de Dados:** MySQL / MariaDB
- **Frontend:** HTML5, Tailwind CSS
- **Servidor:** Apache (recomendado, para uso do `.htaccess`)

## 🚀 Como Instalar e Executar o Projeto

Para executar este projeto no seu ambiente local, siga os passos abaixo.

### Pré-requisitos
- Um ambiente de desenvolvimento local como XAMPP, WAMP ou MAMP instalado.
- Um gestor de banco de dados como phpMyAdmin ou DBeaver.

### Passo a Passo

1.  **Clone o Repositório:**
    ```bash
    git clone <URL_DO_SEU_REPOSITORIO>
    cd votacao-ideias
    ```

2.  **Crie o Banco de Dados:**
    - Aceda ao seu gestor de banco de dados.
    - Crie uma nova base de dados. O nome recomendado é `votacao_ideias_db`.
    - Importe o ficheiro `database.sql` para esta base de dados. Isto irá criar as tabelas necessárias e inserir alguns dados de exemplo.

3.  **Configure a Conexão:**
    - Abra o ficheiro `config.php`.
    - Altere os valores das constantes `DB_HOST`, `DB_NAME`, `DB_USER` e `DB_PASS` para corresponderem às credenciais do seu banco de dados local.

    ```php
    // Exemplo de configuração
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'votacao_ideias_db');
    define('DB_USER', 'root');
    define('DB_PASS', ''); // Geralmente vazio no XAMPP
    ```

4.  **Execute o Servidor:**
    - Certifique-se de que o seu servidor Apache está a ser executado.
    - Coloque a pasta do projeto no diretório apropriado do seu servidor (ex: `htdocs` no XAMPP).

5.  **Aceda à Aplicação:**
    - Abra o seu navegador e aceda ao URL correspondente ao projeto (ex: `http://localhost/votacao-ideias/`).

Pronto! A aplicação deverá estar a funcionar.

## 🏛️ Estrutura do Projeto

O projeto segue o padrão MVC para manter o código organizado e de fácil manutenção:

-   `/controllers`: Recebem as requisições, interagem com os serviços e decidem qual view exibir.
-   `/models`: Representam as tabelas do banco de dados (ex: `Ideia.php` é um "molde" para uma ideia).
-   `/services`: Contêm a lógica de negócio e as regras da aplicação. É aqui que a comunicação com o banco de dados acontece.
-   `/views`: Camada de apresentação (HTML) que exibe os dados para o utilizador.
-   `index.php`: Ponto de entrada que direciona todas as requisições.
-   `.htaccess`: Configuração do Apache para permitir URLs amigáveis.
-   `config.php`: Ficheiro de configuração da aplicação.