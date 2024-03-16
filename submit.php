<?php
// Database connection
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

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prevent SQL injection by using prepared statements
    $employeeNo = $_POST["Employee_No"];
    $logType = $_POST["log_type"];
    $time = $_POST["time"];

     // Check if the employee exists
     $check_query = "SELECT * FROM employee WHERE Employee_No = ?";
     $check_stmt = $conn->prepare($check_query);
     $check_stmt->bind_param("s", $employeeNo);
     $check_stmt->execute();
     $result = $check_stmt->get_result();
 
     if ($result->num_rows == 0) {
         session_start();
         $_SESSION['error_message'] = "Employee not registered.";
         header("Location: attendance_employee.php"); // Redirect to another page with error message
         exit();
     }

    // Prepare SQL statement based on the log type
    if ($logType == "time_in") {
        $sql = "INSERT INTO attendance (Employee_No, time_in, status, admin_approve) VALUES (?, ?, 'waiting', 'pending')";
    } elseif ($logType == "time_out") {
        // Update query corrected
        $sql = "UPDATE attendance 
        SET 
            time_out = ?,
            num_hr = TIME_TO_SEC(TIMEDIFF(time_out, time_in)) / 3600, 
            status = CASE 
                        WHEN TIME_TO_SEC(TIMEDIFF(time_out, time_in)) / 3600 < 9 THEN 'undertime' 
                        ELSE 'overtime'
                     END
        WHERE Employee_No=? AND date = CURDATE()";

    } elseif ($logType == "time_in2") {
        // Update query corrected
        $sql = "UPDATE attendance 
        SET 
            time_in2 = ?, 
            num_hr = TIME_TO_SEC(TIMEDIFF(time_in2, time_in)) / 3600, 
            status = CASE 
                        WHEN TIME_TO_SEC(TIMEDIFF(time_in2, time_in)) / 3600 < 9 THEN 'undertime' 
                        ELSE 'overtime' 
                     END
        WHERE Employee_No=? AND date = CURDATE()";


    } elseif ($logType == "time_out2") {
        // Update query corrected
        $sql = "UPDATE attendance 
        SET 
            time_out2 = ?, 
            num_hr = TIME_TO_SEC(TIMEDIFF(time_out2, time_in)) / 3600, 
            status = CASE 
                        WHEN TIME_TO_SEC(TIMEDIFF(time_out2, time_in)) / 3600 < 9 THEN 'undertime' 
                        ELSE 'overtime' 
                     END
        WHERE Employee_No=? AND date = CURDATE()";

    } else {
        // Handle invalid $logType here
    }
    
    

    // Prepare and bind parameters for execution
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters
        if ($logType == "time_in") {
            $stmt->bind_param("ss", $employeeNo, $time);
        } elseif ($logType == "time_out") {
            $stmt->bind_param("ss", $time, $employeeNo);
        }elseif ($logType == "time_in2") {
            $stmt->bind_param("ss", $time, $employeeNo);
        }elseif ($logType == "time_out2") {
            $stmt->bind_param("ss", $time, $employeeNo);
        }
        session_start();
        // Execute statement
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Record updated successfully";
            header("Location: attendance_employee.php"); // Redirect to another_page.php
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "No data received from the form.";
}

$conn->close();
?>
