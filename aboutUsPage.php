<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tasks Management</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
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
        <header class="header">
            <h2 class="u-name">Tasks <b>Management</b></h2>
            <h3 class="u-name">@<b> <?php echo $username ?></b></h3>
        </header>
        <!-- Page Body -->
        <div class="body">
            <!-- side bar -->
            <nav class="side-bar">
                <div class="user-p">
                    <img src="1.jpg">
                </div>
                <!--Employee Navigation Bar-->
                <?php if ($role === 'admin'): ?>
                    <ul>
                        <li>
                            <a href="DashboardPage.php">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="tasksPage.php">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                                <span>Tasks</span>
                            </a>
                        </li>
                        <li>
                            <a href="createTasksPage.php">
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                                <span>Create Task</span>
                            </a>
                        </li>
                        <li>
                            <a href="ManageUsersPage.php">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="adduserpage.php">
                                <i class="fa fa-check-square" aria-hidden="true"></i>
                                <span>Create Users</span>
                            </a>
                        </li>

                        <li>
                            <a href="profilePage.php">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="aboutUsPage.php">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                <span>About Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="loginpage.php">
                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul>
                        <li>
                            <a href="DashboardPage.php">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="tasksPage.php">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                                <span>My Tasks</span>
                            </a>
                        </li>
                        <li>
                            <a href="profilePage.php">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="aboutUsPage.php">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                <span>About Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="loginpage.php">
                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>

            </nav>
            <!-- main content -->
            <section class="section-1">
                <h1 id="header">Student Names</h1>
                <ul id="names-list">   
                    <li class="name-item">Abdelrhman Hany</li>
                    <li class="name-item">Mohammed Ashraf</li>
                    <li class="name-item">Abdallah Said</li>
                    <li class="name-item">Rofyda Khaled</li>
                    <li class="name-item">Hager Ehab</li>
                    <li class="name-item">Reem Ashraf</li>
                </ul>
            </section>
        </div>
    </body>
</html>



<?php
// Close the connection
mysqli_close($conn);
?>
    
