<?php include '1startingcode.php'; ?>

<!-- Create User Content -->
<h1>Create User</h1>

<form method="post">
    <label>Full Name:</label>
    <input type="text" id="full_name" name="full_name" required><br><br>

    <label>Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label>Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label>Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label>Phone Number:</label>
    <input type="text" id="phone_number" name="phone_number"><br><br>

    <label>Address:</label>
    <textarea id="address" name="address"></textarea><br><br>

    <label>Hire Date:</label>
    <input type="date" id="hire_date" name="hire_date" value="<?php echo date('Y-m-d'); ?>"><br><br>

    <label>Role:</label>
    <select id="role" name="role">
        <option value="admin">Admin</option>
        <option value="employee">Employee</option>
    </select>
    <br><br>

    <input type="submit" name="sub" value="Create User">
</form>

<?php
if (isset($_POST['sub'])) {
    // Get form inputs
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $hire_date = $_POST['hire_date'];
    $role = $_POST['role'];

    // Insert user into the database
    $query = "INSERT INTO users (full_name, username, email, password, phone_number, address, hire_date, role) 
              VALUES ('$full_name', '$username', '$email', '$password', '$phone_number', '$address', '$hire_date', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "User created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>
</body>
</html>
