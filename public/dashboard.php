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
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
<div class="w-full max-w-2xl bg-white p-8 rounded-2xl shadow-md space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold text-gray-800">Gestion des Tâches</h2>
        <a href="../backend/auth.php?logout=true" class="text-red-500 hover:underline text-sm">Déconnexion</a>
    </div>

    <form id="taskForm" class="space-y-4">
        <input type="text" id="title" placeholder="Titre"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">

        <textarea id="description" placeholder="Description"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>

        <select id="priority"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="Basse">Basse</option>
            <option value="Moyenne">Moyenne</option>
            <option value="Haute">Haute</option>
        </select>

        <input type="date" id="due_date"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">

        <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-300">
            Ajouter la tâche
        </button>
    </form>

    <div id="taskList" class="space-y-4">
        <!-- Les tâches seront affichées ici -->
    </div>
</div>

<script src="tasks.js"></script>
</body>
</html>
