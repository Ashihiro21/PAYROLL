<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'payroll_system');

if(isset($_POST['insertdata']))
{
    $time_in= $_POST['time_in'];
    $time_out = $_POST['time_out'];


    $query = "INSERT INTO schedules (`time_in`,`time_out`) VALUES ('$time_in','$time_out')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: nav.php?page=schedule.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}

?>