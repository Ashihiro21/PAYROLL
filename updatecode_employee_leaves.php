<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'payroll_system');

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $leave_type = $_POST['leave_type'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
 

        $query = "UPDATE employee_leaves SET leave_type='$leave_type',start_date='$start_date',end_date='$end_date' WHERE id='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:employee_main.php?page=employee_leaves.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>