<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'payroll_system');

if(isset($_POST['insertdata']))
{
    $description= $_POST['description'];
    $amount = $_POST['amount'];


    $query = "INSERT INTO deduction (`description`,`amount`) VALUES ('$description','$amount')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: nav.php?page=deduction.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}

?>