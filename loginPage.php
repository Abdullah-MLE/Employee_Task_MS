<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="loginPage.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" name="login" value="login">
    </form>

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

    // Handle form submission
    if (isset($_POST["login"])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $_SESSION['id'] = $row['id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone_number'] = $row['phone_number'];
            $_SESSION['profile_picture'] = $row['profile_picture'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['hire_date'] = $row['hire_date'];

            header("Location: dashboardPage.php");
        } else {
            echo "Invalid username or password.";
        }
    }

    // Close the connection
    mysqli_close($conn);
    ?>
</body>
</html>
