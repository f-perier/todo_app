<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestionnaire de Tâches</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/style.css">

</head>
<body class="bg_img">
    <div class="max-w-md my-64 mx-auto bg-white p-5 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Connexion</h2>

        <form id="connect" action="backend/auth.php" method="POST" class="mb-4">
            <input type="text" name="username" placeholder="Nom d'utilisateur" class="w-full p-2 border rounded mb-2" required>
            <input type="password" name="password" placeholder="Mot de passe" class="w-full p-2 border rounded mb-2" required>
            <button type="submit" name="login" class="bg-blue-500 text-white p-2 rounded w-full">Se connecter</button>
        </form>
        <div class="flex justify-center">
            <a href="backend/auth.php" class="bg-blue-500 text-white p-2 rounded w-32 text-center block">S'inscrire</a>
        </div>
    </div>
    <script src="public/tasks.js"></script>
</body>
</html>
