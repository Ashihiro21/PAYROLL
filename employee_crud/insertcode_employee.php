<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'payroll_system');

if(isset($_POST['insertdata']))
{
    // Generate a random 6-character uppercase alphanumeric string
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_chars = strtoupper(substr(str_shuffle($characters), 0, 6));

    // Generate a random 6-digit number
    $random_number = sprintf('%06d', mt_rand(0, 999999));

    // Combine the characters and numbers to create the Employee_No
    $Employee_No = $random_chars . $random_number;

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $department = $_POST['department'];
    $position = $_POST['position'];

    // File upload handling
    $target_dir = "img/";  // Adjust this path to your desired upload directory
    $target_file = $target_dir . basename($_FILES["images"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script> alert("Sorry, your file was not uploaded."); </script>';
    } else {
        if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
            $images = $target_file;

            // Insert data into the database
            $query = "INSERT INTO employee (`Employee_No`,`images`,`first_name`,`last_name`,`department`,`position`) VALUES ('$Employee_No','$images','$first_name','$last_name','$department','$position')";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                echo '<script> alert("Data Saved"); </script>';
                header('Location: nav.php?page=employee.php');
            }
            else
            {
                echo '<script> alert("Data Not Saved"); </script>';
            }
        } else {
            echo '<script> alert("Sorry, there was an error uploading your file."); </script>';
        }
    }
}

?>
