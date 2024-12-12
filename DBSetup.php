<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$dbpassword = ""; 
$port = 3308; 
$dbname = "website_project";

// Create connection
$conn = mysqli_connect($servername, $username, $dbpassword, $dbname, $port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully!</br>";

// Drop tables if they exist
$conn->query("DROP TABLE IF EXISTS tasks;");
$conn->query("DROP TABLE IF EXISTS users;");
echo "Table 'users' dropped.</br>Table 'tasks' dropped.</br>";

// SQL to create users table
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'employee') NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15),
    profile_picture VARCHAR(255),
    address TEXT,
    hire_date TIMESTAMP
);";

// SQL to create tasks table
$sql_tasks = "CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    assigned_to VARCHAR(50), -- Matches the username column in users
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    due_date TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(username)
);";

// Execute table creation queries
if ($conn->query($sql_users)) {
    echo "Table 'users' created successfully.</br>";
} else {
    echo "Error creating table 'users': " . mysqli_error($conn) . "</br>";
}

if ($conn->query($sql_tasks)) {
    echo "Table 'tasks' created successfully.</br>";
} else {
    echo "Error creating table 'tasks': " . mysqli_error($conn) . "</br>";
}

// Insert default data into the users table
$sql_insert_users = "INSERT INTO users (full_name, username, password, role, email, phone_number, profile_picture, address, hire_date) VALUES
    ('manager1', 'admin', '123', 'admin', 'ma@g.com', '01234567890', '1.png', 'address 1', '2020-01-01'),
    ('manager2', 'admin2', '123', 'admin', 'ma@g.com', '01234567890', '1.png', 'address 1', '2020-07-01'),
    ('employee1', 'user1', '123', 'employee', 'user1@g.com', '01111111111', '2.png', 'address 2', '2017-12-11'),
    ('employee2', 'user2', '123', 'employee', 'user2@g.com', '01111111111', '2.png', 'address 2', '2019-08-30'),
    ('employee3', 'user3', '123', 'employee', 'user3@g.com', '01111111111', '2.png', 'address 2', '2025-05-03'),
    ('employee4', 'user4', '123', 'employee', 'user4@g.com', '01111111111', '2.png', 'address 2', '2008-01-07'),
    ('employee5', 'user5', '123', 'employee', 'user5@g.com', '01111111111', '2.png', 'address 2', '2004-01-06');";

// Insert default data into the tasks table
$sql_insert_tasks = "INSERT INTO tasks (title, description, assigned_to, status, due_date) VALUES
    ('Task 1', 'Description for task 1', 'user2', 'pending', '2024-12-31'),
    ('Task 2', 'Description for task 2', 'user3', 'in_progress', '2024-12-20'),
    ('Task 3', 'Description for task 3', 'user3', 'completed', '2024-12-20'),
    ('Task 4', 'Description for task 4', 'user3', 'completed', '2024-12-20'),
    ('Task 5', 'Description for task 5', 'user2', 'in_progress', '2024-12-20'),
    ('Task 6', 'Description for task 6', 'user2', 'completed', '2024-12-20');";

// Execute insert queries
if ($conn->query($sql_insert_users)) {
    echo "Default users inserted successfully!</br>";
} else {
    echo "Error inserting default users: " . mysqli_error($conn) . "</br>";
}

if ($conn->query($sql_insert_tasks)) {
    echo "Default tasks inserted successfully!</br>";
} else {
    echo "Error inserting default tasks: " . mysqli_error($conn) . "</br>";
}

// Close connection
mysqli_close($conn);
?>
