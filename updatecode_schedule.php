<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'payroll_system');

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $time_in = $_POST['time_in'];
        $time_out = $_POST['time_out'];
 

        $query = "UPDATE schedules SET time_in='$time_in', time_out='$time_out' WHERE id='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:nav.php?page=schedule.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>