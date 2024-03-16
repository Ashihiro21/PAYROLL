<!DOCTYPE html>
<html>
<head>
    <title>Insert/Update Time</title>
</head>
<body>

<?php
// Define your database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values
    $employeeNo = $_POST["Employee_No"];
    $currentTime = date("g:i:s a");



    // Determine which button was clicked
    if (isset($_POST['time_in'])) {
        // Insert time_in record
        $sql = "INSERT INTO insertion (Employee_no, time_in) VALUES ('$employeeNo', '$currentTime')";
    } elseif (isset($_POST['time_out'])) {
        // Update time_out record
        $sql = "UPDATE insertion SET time_out='$currentTime', num_hr = time_out - time_in WHERE Employee_no='$employeeNo'";
    }

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="Employee_No">Employee Number:</label><br>
    <input type="text" id="Employee_No" name="Employee_No"><br><br>
    <button type="submit" name="time_in">Time in</button>
    <button type="submit" name="time_out">Time out</button>
</form>

</body>
</html>
