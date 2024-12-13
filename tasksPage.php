<?php include '1startingcode.php';?>

    <!-- TasksPage Content -->
    <?php
        ob_start();
    ?>

    <h1>Welcome to the Task List <?= $full_name ?>!</h1>

    <?php if ($role === 'admin'): ?>
        <a href="createTasksPage.php">Create New Task</a>
        <table>
            <!-- heder row -->
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
            <!-- repeted rows -->
            <?php
                // get the database
                $tasksDB = mysqli_query($conn, "SELECT * FROM tasks");

                // Loop through each row
                while ($task = mysqli_fetch_assoc($tasksDB)) {
                    echo "<tr>";

                    echo "<th>" . htmlspecialchars($task['id']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['title']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['description']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['assigned_to']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['status']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['due_date']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['created_at']) . "</th>";

                    echo "<td>
                            <form method='post'>
                                <input type='hidden' name='task_id' value='" . $task['id'] . "' />
                                <button type='submit' name='delete'>Delete</button>
                                <button type='submit' name='edit'>Edit</button>
                            </form>
                        </td>";
                    
                    echo "</tr>";
                }
            ?>
        </table>

        <?php    
            if (isset($_POST['delete'])) {
                $task_id = $_POST['task_id'];

                // delet the task
                mysqli_query($conn, "DELETE FROM tasks WHERE id = $task_id");
                header("Refresh:0");
            }

            if (isset($_POST['edit'])) {
                $task_id = $_POST['task_id'];
                header("Location: editTasksPage.php");
                $_SESSION['taskid'] = $task_id;
            }
        ?>
    <?php else: ?>
        <table>
            <!-- header row -->
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Created At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <!-- repeated rows -->
            <?php 
                // Get user tasks
                $tasksDB = mysqli_query($conn, "SELECT * FROM tasks WHERE assigned_to = '$username'");

                // Loop through each task
                while ($task = mysqli_fetch_assoc($tasksDB)) {
                    echo "<tr>";

                    echo "<th>" . htmlspecialchars($task['id']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['title']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['description']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['due_date']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['created_at']) . "</th>";
                    echo "<th>" . htmlspecialchars($task['status']) . "</th>";
                    
                    echo "<td> 
                        <form method='post'>
                        <input type='hidden' name='task_id' value='" . $task['id'] . "' /> 
                        <button type='submit' name='edit'>Edit</button> 
                        </form> 
                    </td>";
                    echo "</tr>";
                }
            ?>
        </table>

        <?php 
            // Edit task
            if (isset($_POST['edit'])) {
                $task_id = $_POST['task_id'];
                header("Location: editTasksPage.php");
                $_SESSION['taskid'] = $task_id;
            }
        ?>
    <?php endif; ?>
    
    <?php
    $conn->close();
    ?>

