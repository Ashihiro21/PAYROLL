<?php
// Check if the form is submitted
if(isset($_POST['insertdata'])) {
    // Include your database connection file
    include 'db_config.php';

    // Retrieve form data
    $employee_id = $_POST['Employee_No'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];

    // Perform database insert operation using prepared statements to prevent SQL injection
    $sql = "INSERT INTO employee_leaves (Employee_No, first_name, last_name, email, leave_type, start_date, end_date, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$employee_id, $first_name, $last_name, $email, $leave_type, $start_date, $end_date, $status]);

    // Check if insertion was successful
    if($stmt->rowCount() > 0) {
        echo "Records inserted successfully.";
        header("Location: employee_main.php?page=employee_leaves.php");
    } else {
        echo "ERROR: Could not able to execute $sql.";
    }

    // Close statement and database connection
    $stmt = null;
    $conn = null;
}
?>
