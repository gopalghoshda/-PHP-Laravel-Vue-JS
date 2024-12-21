<?php

function loadTasks() {
    $tasks = [];
    if (file_exists('tasks.json')) {
        $tasks = json_decode(file_get_contents('tasks.json'), true);
    }
    return $tasks;
}

function saveTasks($tasks) {
    file_put_contents('tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));
}

$tasks = loadTasks();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'add') {
            $task = htmlspecialchars(trim($_POST['task']));
            if ($task !== '') {
                $tasks[] = ['text' => $task, 'done' => false];
            }
        } elseif ($action === 'delete') {
            $index = intval($_POST['index']);
            unset($tasks[$index]);
            $tasks = array_values($tasks);
        } elseif ($action === 'toggle') {
            $index = intval($_POST['index']);
            $tasks[$index]['done'] = !$tasks[$index]['done'];
        }

        saveTasks($tasks);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
</head>
<body>
    <div class="container">
        <h1>To-Do App</h1>

        <form method="POST">
            <input type="text" name="task" placeholder="Add a new task">
            <button type="submit" name="action" value="add">Add Task</button>
        </form>

        <ul>
            <?php foreach ($tasks as $index => $task): ?>
                <li style="text-decoration: <?= $task['done'] ? 'line-through' : 'none'; ?>;">
                    <?= htmlspecialchars($task['text']) ?>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <button type="submit" name="action" value="toggle">Mark as <?= $task['done'] ? 'Undone' : 'Done'; ?></button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <button type="submit" name="action" value="delete">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>