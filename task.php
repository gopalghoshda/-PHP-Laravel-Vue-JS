<?php
if (isset($_POST['add-task'])) {
    $task = htmlspecialchars(trim($_POST['task']));  // Sanitize input
    if (!empty($task)) {
        $tasks = json_decode(file_get_contents('tasks.json'), true);
        $newTask = [
            'task' => $task,
            'done' => false
        ];
        $tasks[] = $newTask;

        file_put_contents('tasks.json', json_encode($tasks, JSON_PRETTY_PRINT)); // Save tasks
        header("Location: index.php"); // Redirect after action
        exit();
    }
}
?>
