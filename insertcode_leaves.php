<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'payroll_system');

if(isset($_POST['insertdata']))
{
    $leave_type= $_POST['leave_type'];


    $query = "INSERT INTO leaves (`leave_type`) VALUES ('$leave_type')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: nav.php?page=leave.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}

?>