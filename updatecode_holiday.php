<?php
// Check if the form is submitted
if (isset($_POST['update_id'])) {

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "payroll_system";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $update_id = $_POST['update_id'];
    $tittle = $_POST['tittle'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $type = $_POST['type'];

    // SQL query to update data in the database
    $sql = "UPDATE holiday SET tittle='$tittle', date='$date', description='$description', type='$type' WHERE id='$update_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Data updated successfully");</script>';
        
        // Redirect to a specific page (change "your_page.php" to the desired page)
        echo '<script>window.location.href = "nav.php?page=holiday.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
