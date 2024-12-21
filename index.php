<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>To-Do App</h1>

        <form action="task.php" method="POST">
            <input type="text" name="task" id="task-input" placeholder="Enter a task" required>
            <button type="submit" name="add-task">Add Task</button>
        </form>

        <ul id="task-list">
            <!-- Tasks will be populated here -->
            <?php
                // Load tasks from the JSON file
                $tasks = json_decode(file_get_contents('tasks.json'), true);

                foreach ($tasks as $task) {
                    echo '<li class="task' . ($task['done'] ? ' done' : '') . '">
                            <span>' . htmlspecialchars($task['task']) . '</span>
                            <button class="delete-btn" onclick="deleteTask(' . $task['id'] . ')">Delete</button>
                            <button class="toggle-btn" onclick="toggleTask(' . $task['id'] . ')">Toggle</button>
                          </li>';
                }
            ?>
        </ul>
    </div>

</body>
</html>
