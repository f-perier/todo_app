<?php
include_once '../includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 p-5">
<div class="max-w-2xl mx-auto bg-white p-5 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Gestion des Tâches</h2>
    <a href="../backend/auth.php?logout=true" class="text-red-500">Déconnexion</a>

    <form id="taskForm" class="mb-4">
        <input type="text" id="title" placeholder="Titre" class="w-full p-2 border rounded mb-2">
        <textarea id="description" placeholder="Description" class="w-full p-2 border rounded mb-2"></textarea>
        <select id="priority" class="w-full p-2 border rounded mb-2">
            <option value="Basse">Basse</option>
            <option value="Moyenne">Moyenne</option>
            <option value="Haute">Haute</option>
        </select>
        <input type="date" id="due_date" class="w-full p-2 border rounded mb-2">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded w-full">Ajouter</button>
    </form>

    <div id="taskList"></div>

</div>
<script src="tasks.js"></script>
</body>
</html>
