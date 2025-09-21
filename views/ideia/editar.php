
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ideia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gradient-to-br from-purple-50 to-blue-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg mx-auto p-6 bg-white rounded-xl shadow-2xl">
        <header class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-purple-800 mb-2">Editar Ideia</h1>
            <p class="text-gray-500">Ajuste os detalhes da sua ideia e salve as alterações.</p>
        </header>
        <main>
            <?php require __DIR__ . '/../../templates/editar.php'; ?>
        </main>
    </div>
</body>
</html>
