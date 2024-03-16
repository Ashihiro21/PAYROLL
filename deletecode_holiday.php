<?php
// Check if the form is submitted
if(isset($_POST['delete_id'])) {
    
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
    $delete_id = $_POST['delete_id'];
    
    // SQL query to delete data from the database
    $sql = "DELETE FROM holiday WHERE id='$delete_id'";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Data Deleted successfully");</script>';
        
        // Redirect to a specific page (change "your_page.php" to the desired page)
        echo '<script>window.location.href = "nav.php?page=holiday.php";</script>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}
?>
