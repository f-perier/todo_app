<?php
global $pdo;
session_start();
require '../includes/db.php';


// Inscription

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    try {
        // Vérifier si l'utilisateur existe déjà
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$_POST['username']]);
        $userExists = $stmt->fetchColumn();

        if ($userExists) {
            echo "Nom d'utilisateur déjà pris";
        } else {
            // ajout nouvel utilisateur
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT)]);
            header('Location: ../public/index.php');
            exit();
        }
        // Gestion des erreurs
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

// Connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../public/dashboard.php');
        exit();
    } else {
        echo "Identifiants incorrects";
    }
}

// Déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestionnaire de Tâches</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../public/style.css">


</head>
<body class="bg_img">
<div class="max-w-md my-64 mx-auto bg-white p-5 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-4">Inscription</h2>
    <form method="POST" class="space-y-4 border-t pt-6">
        <h3 class="text-lg font-semibold text-gray-700">Inscription</h3>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
        <input type="password" name="password" placeholder="Mot de passe" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
        <button type="submit" name="register"
                class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-300">S'inscrire</button>
    </form>



</body>
</html>

