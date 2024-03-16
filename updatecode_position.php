<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'payroll_system');

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $position = $_POST['position'];
        $rate = $_POST['rate'];
 

        $query = "UPDATE position SET position='$position', rate='$rate' WHERE id='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:nav.php?page=position.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>