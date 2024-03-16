<?php
// update_image.php

if (isset($_POST['update_image'])) {
    $employeeId = $_POST['update_image_id'];

    // Check if a file was uploaded
    if (isset($_FILES['new_image'])) {
        $file = $_FILES['new_image'];

        // File properties
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // File extension
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        // Check if the uploaded file is an allowed type
        if (in_array($fileExt, $allowedExtensions)) {
            // Check for file errors
            if ($fileError === 0) {
                // Generate a unique file name to avoid overwriting existing files
                $newFileName = 'employee_' . $employeeId . '.' . $fileExt;

                // Set the file path
                $fileDestination = 'img/' . $newFileName;

                // Move the uploaded file to the destination directory
                move_uploaded_file($fileTmpName, $fileDestination);

                // Update the database with the new image path
                $connection = mysqli_connect("localhost", "root", "");
                $db = mysqli_select_db($connection, 'payroll_system');

                $query = "UPDATE employee SET images = '$fileDestination' WHERE id = $employeeId";
                $query_run = mysqli_query($connection, $query);

                if ($query_run) {
                    // Display alert
                    echo "<script>alert('Image updated successfully!');</script>";

                    // Redirect to a new page
                    header("Location: nav.php?page=employee.php"); // Replace 'index.php' with the desired destination
                    exit;
                } else {
                    echo "Error updating image: " . mysqli_error($connection);
                }

            } else {
                echo "Error uploading file: " . $fileError;
            }

        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "No file uploaded.";
    }
}
?>
