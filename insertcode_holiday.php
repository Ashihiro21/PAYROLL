<?php
// Check if the form is submitted
if(isset($_POST['insertdata'])){
    
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
    $tittle = $_POST['tittle'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    
    // SQL query to insert data into the database
    $sql = "INSERT INTO holiday (tittle, date, description, type) VALUES ('$tittle', '$date', '$description', '$type')";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Data Insert successfully");</script>';
        
        // Redirect to a specific page (change "your_page.php" to the desired page)
        echo '<script>window.location.href = "nav.php?page=holiday.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}
?>
