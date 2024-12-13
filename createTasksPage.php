<?php include '1startingcode.php'; ?>

<!-- Create Task Content -->
<h1>Create task, <?= $username ?>!</h1>

<form method="post">
    <label>Task title:</label>
    <input type="text" id="title" name="title"><br><br>

    <label>Task description:</label>
    <textarea id="description" name="description"></textarea><br><br>
    <label>Task will be assigned to:</label>
    <select name="assigned_to">
        <?php
            // Fetch full_name and username
            $query = "SELECT username, full_name FROM users WHERE role = 'employee';";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                // Populate the drop-down menu with employee names and usernames
                echo "<option value='" . $row['username'] . "'>" . $row['full_name'] . "</option>";
            }

        ?>
    </select>
    <br><br>

    <label>Task status:</label>
    <select id="status" name="status">
        <option value="pending">Pending</option>
        <option value="in_progress">In progress</option>
        <option value="completed">Completed</option>
    </select>
    <br><br>

    <label>Due Date:</label>
    <input type="date" id="due_date" name="due_date" value="<?php echo date('Y-m-d'); ?>">
    <br><br>

    <input type="submit" name="sub" value="Submit!">
</form>

<?php
if (isset($_POST['sub'])) {
    // Get form inputs
    $title = $_POST['title'];
    $description = $_POST['description'];
    $assigned_to = $_POST['assigned_to'];
    $status = $_POST['status'];
    $due_date = $_POST['due_date'];

    // Insert task into the database
    $query = "INSERT INTO tasks (title, description, assigned_to, status, due_date) 
              VALUES ('$title', '$description', '$assigned_to', '$status', '$due_date')";

    if (mysqli_query($conn, $query)) {
        echo "Task created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>
</body>
</html>
