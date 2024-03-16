<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'payroll_system');

if(isset($_POST['insertdata']))
{
    $position= $_POST['position'];
    $rate = $_POST['rate'];


    $query = "INSERT INTO position (`position`,`rate`) VALUES ('$position','$rate')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: nav.php?page=position.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}

?>