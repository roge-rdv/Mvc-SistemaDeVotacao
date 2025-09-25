<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Votação de Ideias</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f9; color: #333; }
        .container { max-width: 400px; margin: 60px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        h1 { color: #5a2d82; }
        label { display: block; margin-bottom: 6px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-bottom: 14px; border-radius: 4px; border: 1px solid #ccc; }
        button { background: #5a2d82; color: #fff; border: none; border-radius: 4px; padding: 8px 18px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="<?php echo BASE_URL; ?>/login">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
