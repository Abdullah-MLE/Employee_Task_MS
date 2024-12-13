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


    <h1>Welcome to the Dashboard, <?= $full_name ?>!</h1>

    <!-- Dashboard Content -->
    <section>
        <?php if ($role === 'admin'): ?>
            <p>Total Employees: 
                <?= mysqli_fetch_assoc($conn->query("SELECT COUNT(*) AS total FROM users"))['total']; ?>
            </p>
            <p>Total Tasks: 
                <?= mysqli_fetch_assoc($conn->query("SELECT COUNT(*) AS total FROM tasks"))['total']; ?>
            </p>
            <p>All Tasks with available time: 
                <?= mysqli_fetch_assoc($conn->query("SELECT COUNT(*) AS total FROM tasks WHERE due_date > NOW()"))['total']; ?>
            </p>
            <p>Overdue and Incomplete Tasks: 
                <?= mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tasks WHERE due_date < NOW() AND status != 'completed'"))['total']; ?>
            </p>
            <p>Tasks Pending: 
                <?= mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tasks WHERE status = 'pending'"))['total']; ?>
            </p>
            <p>Tasks In Progress: 
                <?= mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tasks WHERE status = 'in_progress'"))['total']; ?>
            </p>
            <p>Completed Tasks: 
                <?= mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tasks WHERE status = 'completed'"))['total']; ?>
            </p>
        <?php else: ?>
            <p>Your Total Tasks: 
                <?= mysqli_fetch_assoc($conn->query("SELECT COUNT(*) AS total FROM tasks WHERE assigned_to = '$username'"))['total']; ?>
            </p>
            <p>Tasks still available time: 
                <?= mysqli_fetch_assoc($conn->query("SELECT COUNT(*) AS total FROM tasks WHERE assigned_to = '$username' AND due_date > NOW()"))['total']; ?>
            </p>
            <p>Overdue, Incomplete Tasks: 
                <?= mysqli_fetch_assoc($conn->query("SELECT COUNT(*) AS total FROM tasks WHERE assigned_to = '$username' AND due_date < NOW() AND status != 'completed'"))['total']; ?>
            </p>
            <p>Your Pending Tasks: 
                <?= mysqli_fetch_assoc($conn->query("SELECT COUNT(*) AS total FROM tasks WHERE assigned_to = '$username' AND status = 'pending'"))['total']; ?>
            </p>
            <p>Your In Progress Tasks: 
                <?= mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tasks WHERE assigned_to = '$username' AND status = 'in progress'"))['total']; ?>
            </p>
            <p>Your Completed Tasks: 
                <?= mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tasks WHERE assigned_to = '$username' AND status = 'completed'"))['total']; ?>
            </p>
        <?php endif; ?>
    </section>

    <?php
    // Close the connection
    mysqli_close($conn);
    ?>
</body>
</html>
