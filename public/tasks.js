document.addEventListener("DOMContentLoaded", function() {
    loadTasks();
    document.getElementById("taskForm").addEventListener("submit", function(e) {
        e.preventDefault();
        addTask();
    });
});

function loadTasks() {
    fetch("../backend/tasks.php?get_tasks=true")
        .then(response => response.json())
        .then(data => {
            let taskList = document.getElementById("taskList");
            taskList.innerHTML = "";
            data.forEach(task => {
                let statusClass = task.status === "Terminée" ? "bg-green-200" : "bg-gray-200";
                taskList.innerHTML += `
                    <div class="p-3 mb-2 ${statusClass} rounded">
                        <h3 class="font-bold">${task.title}</h3>
                        <p>${task.description}</p>
                        <p class="text-sm text-gray-600">Priorité: ${task.priority} | Date limite: ${task.due_date}</p>
                        <button onclick="deleteTask(${task.id})" class="text-red-500">Supprimer</button>
                    </div>`;
            });
        });
}

function addTask() {
    let formData = new FormData();
    formData.append("add_task", true);
    formData.append("title", document.getElementById("title").value);
    formData.append("description", document.getElementById("description").value);
    formData.append("priority", document.getElementById("priority").value);
    formData.append("due_date", document.getElementById("due_date").value);

    fetch("../backend/tasks.php", { method: "POST", body: formData })
        .then(response => response.json())
        .then(() => {
            document.getElementById("taskForm").reset();
            loadTasks();
        });
}
function deleteTask(id) {
    const formData = new FormData();
    formData.append("delete_task", true);
    formData.append("task_id", id);

    fetch("../backend/tasks.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(() => {
            loadTasks();
            console.logo
        });
}