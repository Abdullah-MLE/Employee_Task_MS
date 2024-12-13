<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <!-- DB CONNECTION -->
    <?php
        // Database connection setup
        $servername = "localhost";
        $username = "root";
        $dbpassword = "";
        // $port = 3308;
        $dbname = "website_project";

        // Create connection
        $conn = mysqli_connect($servername, $username, $dbpassword, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $id = $_SESSION['id'];
        $full_name = $_SESSION['full_name'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $role = $_SESSION['role'];
        $email = $_SESSION['email'];
        $phone_number = $_SESSION['phone_number'];
        $profile_picture = $_SESSION['profile_picture'];
        $address = $_SESSION['address'];
        $created_at = $_SESSION['hire_date'];
    ?>
    
    <!-- Navigation Bar -->
    <?php if ($role === 'admin'): ?>
        <nav>
            <ul>
                <li><a href='DashboardPage.php'>Dashboard</a></li>
                <li><a href='tasksPage.php'>Tasks</a></li>
                <li><a href='createTasksPage.php'>create task</a></li>
                <li><a href='ManageUsersPage.php'>Users</a></li>
                <li><a href='adduserpage.php'>Add User</a></li>
                <li><a href='profilePage.php'>Profile</a></li>
                <li><a href='aboutUsPage.php'>About Us</a></li>
            </ul>
            <p><?= $full_name ?></p>
        </nav>
    <?php else: ?>
        <nav>
            <ul>
                <li><a href='DashboardPage.php'>Dashboard</a></li>
                <li><a href='tasksPage.php'>All Tasks</a></li>
                <li><a href='profilePage.php'>Profile</a></li>
                <li><a href='aboutUsPage.php'>About Us</a></li>
            </ul>
        </nav>
    <?php endif; ?>

    <!-- TasksPage Content -->
    <?php
        ob_start();
    ?>
    <h1>Welcome to the Task List <?= $full_name ?>!</h1>
    <a href="createTasksPage.php">Create New Task</a>

    <table>
        <!-- heder row -->
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Assigned To</th>
            <th>Due Date</th>
            <th>Created At</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <!-- repeted rows -->
        <?php
            // get the database
            $tasksDB = $conn->query("SELECT * FROM tasks");

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
            $conn->query("DELETE FROM tasks WHERE id = $task_id");
            header("Refresh:0");
        }

        if (isset($_POST['edit'])) {
            $task_id = $_POST['task_id'];
            header("Location: editTasksPage.php");
            $_SESSION['taskid'] = $task_id;
        }
    ?>


    <?php

    $conn->close();
    ?>

