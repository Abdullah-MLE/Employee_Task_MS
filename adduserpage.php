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


    <h1>Welcome to the About Us Page, <?= $full_name ?>!</h1>

    

    <?php
    // Close the connection
    mysqli_close($conn);
    ?>
</body>
</html>
