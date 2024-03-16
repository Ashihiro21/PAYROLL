<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'payroll_system');

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id'];
    $admin_approval = $_POST['admin_approve']; // Corrected to match the name attribute in HTML

    // Perform different actions based on the selected option
    switch ($admin_approval) {
        case "Pending":
            // Code for pending approval
            $query = "UPDATE attendance SET admin_approve='Pending' WHERE id='$id'";
            break;
        case "Reject":
            // Code for rejection
            $query = "UPDATE attendance SET admin_approve='Reject', num_hr='9' WHERE id='$id'";
            break;
        case "Approve":
            // Code for approval
            $query = "UPDATE attendance SET admin_approve='Approve' WHERE id='$id'";
            break;
        default:
            // Default action if none of the above cases match
            break;
    }

    // Execute the query
    $query_run = mysqli_query($connection, $query);

    // Check if the query executed successfully
    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: nav.php?page=attendance.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
?>
