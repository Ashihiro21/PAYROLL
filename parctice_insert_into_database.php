<?php
// Database credentials
$servername = "localhost"; // Change this to your server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "payroll_system"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Check if request is POST and form data is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"]) && isset($_POST["age"]) && isset($_POST["button"])) {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $buttonClicked = $_POST["button"];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO insertion (name, age, button_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $age, $buttonClicked);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data: " . $conn->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "Error: Invalid request.";
}

// Close database connection
$conn->close();
?>
