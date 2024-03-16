<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'payroll_system');

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $description = $_POST['description'];
        $amount = $_POST['amount'];
 

        $query = "UPDATE deduction SET description='$description', amount='$amount' WHERE id='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:nav.php?page=deduction.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>