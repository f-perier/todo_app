<?php
global $pdo;
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "Utilisateur non connecté"]);
    exit();
}

$userId = $_SESSION['user_id'];

// Ajouter une tâche
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $priority = isset($_POST['priority']) ? $_POST['priority'] : 'Moyenne';
    $due_date = isset($_POST['due_date']) ? $_POST['due_date'] : null;

    if (empty($title)) {
        echo json_encode(["success" => false, "error" => "Le titre est obligatoire"]);
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, priority, due_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$userId, $title, $description, $priority, $due_date]);

    echo json_encode(["success" => true]);
    exit();
}

// Modifier une tâche
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_task'])) {
    $taskId = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];
    $status = isset($_POST['status']) ? $_POST['status'] : "En cours";

    $stmt = $pdo->prepare("UPDATE tasks SET title=?, description=?, priority=?, due_date=?, status=? WHERE id=? AND user_id=?");
    $stmt->execute([$title, $description, $priority, $due_date, $status, $taskId, $userId]);

    echo json_encode(["success" => true]);
    exit();
}

// Supprimer une tâche
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_task'])) {
    if (!empty($_POST['task_id'])) {
        $taskId = $_POST['task_id'];

        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id=? AND user_id=?");
        $stmt->execute([$taskId, $userId]);

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "ID de tâche manquant"]);
    }
    exit();
}

// Récupérer les tâches
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['get_tasks'])) {
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id=? ORDER BY due_date, priority");
    $stmt->execute([$userId]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tasks);
    exit();
}

