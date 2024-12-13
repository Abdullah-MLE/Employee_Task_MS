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
            <li><a href='createTasksPage.php'>Create Task</a></li>
            <li><a href='ManageUsersPage.php'>Manage Users</a></li>
            <li><a href='tasksPage.php'>All Tasks</a></li>
            <li><a href='notificationPage.php'>Notifications</a></li>
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
            <li><a href='notificationPage.php'>Notifications</a></li>
            <li><a href='profilePage.php'>Profile</a></li>
            <li><a href='aboutUsPage.php'>About Us</a></li>
        </ul>
    </nav>
    <?php endif; ?>

    <!-- TasksPage Content -->
    <h1>Welcome to the Task List <?= $full_name ?>!</h1>
    <a href="createTask.php" class="btn">Create New Task</a>

    <table>
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
        <table>
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
    <?php
    // Fetch all tasks from the database
    $tasksQuery = mysqli_query($conn, "SELECT * FROM tasks");

    // Loop through each task
    while ($task = mysqli_fetch_assoc($tasksQuery)) {
        echo "<tr id='row-" . $task['id'] . "'>"; // Assign an ID to the row for easy deletion with JavaScript
        
        // Loop through each column in the task
        foreach ($task as $key => $value) {
            echo "<td>$value</td>";
        }

        // Add action buttons (Edit and Delete)
        echo "<td>
                <a href='editTasksPage.php?id=" . $task['id'] . "' class='btn'>Edit</a>
                <button onclick='deleteTask(" . $task['id'] . ")'>Delete</button>
                <button onclick='deleteTask(" . $task['id'] . ")'>Delete</button>
              </td>";
        
        echo "</tr>";
    }
    ?>
</table>

<script>
    // Function to delete a task with AJAX
    function deleteTask(taskId) {
        if (confirm("Are you sure you want to delete this task?")) { // Show a confirmation alert
            const xhr = new XMLHttpRequest(); // Create an XMLHttpRequest object
            xhr.open("POST", "deleteTask.php", true); // Set the request to POST and target 'deleteTask.php'
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Set the request header
            xhr.onload = function () {
                if (xhr.status === 200) { // Check if the response is OK
                    alert("Task deleted successfully!"); // Show success message
                    document.getElementById("row-" + taskId).remove(); // Remove the row from the table
                } else {
                    alert("Failed to delete the task. Please try again."); // Show error message
                }
            };
            xhr.send("id=" + taskId); // Send the task ID to the server
        }
    }
</script>

        
    </table>

    <?php

    $conn->close();
    ?>

