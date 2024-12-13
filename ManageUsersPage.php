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

    <!-- UsersPage Content -->
    <?php 
    ob_start(); 
    ?>
    <h1>Welcome to the Users List <?= $full_name ?>!</h1>
    <a href="createUsersPage.php">Create New User</a>
    <table>
        <!-- header row -->
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <!-- repeated rows -->
        <?php 
        // Get users data from database
        $usersDB = $conn->query("SELECT * FROM users");

        // Loop through each row
        while ($user = mysqli_fetch_assoc($usersDB)) {
            echo "<tr>";
            echo "<th>" . htmlspecialchars($user['id']) . "</th>";
            echo "<th>" . htmlspecialchars($user['full_name']) . "</th>";
            echo "<th>" . htmlspecialchars($user['username']) . "</th>";
            echo "<th>" . htmlspecialchars($user['email']) . "</th>";
            echo "<th>" . htmlspecialchars($user['phone_number']) . "</th>";
            echo "<th>" . htmlspecialchars($user['role']) . "</th>";
            echo "<th>" . htmlspecialchars($user['hire_date']) . "</th>";
            echo "<td> 
                <form method='post'>
                <input type='hidden' name='user_id' value='" . $user['id'] . "' /> 
                <button type='submit' name='delete'>Delete</button> 
                <button type='submit' name='edit'>Edit</button> 
                </form> 
            </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php 
    // Delete user
    if (isset($_POST['delete'])) {
        $user_id = $_POST['user_id'];
        $conn->query("DELETE FROM users WHERE id = $user_id");
        header("Refresh:0");
    }

    // Edit user
    if (isset($_POST['edit'])) {
        $user_id = $_POST['user_id'];
        header("Location: edituserPage.php");
        $_SESSION['userid'] = $user_id;
    }
?>


<?php

$conn->close();
?>


