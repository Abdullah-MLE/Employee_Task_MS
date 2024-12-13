<?php include '1startingcode.php';?>

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
        $usersDB = mysqli_query($conn, "SELECT * FROM users");

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
        mysqli_query($conn, "DELETE FROM users WHERE id = $user_id");
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


