<?php
session_start();
include_once('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['email'])) {
    // Validate and sanitize the input (add more validation as needed)
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Process and save the uploaded image
    $imagePath = 'img/'; // Specify the folder where you want to save the images
    $imageName = $_FILES['profileImage']['name'];
    $imageTemp = $_FILES['profileImage']['tmp_name'];
    $imageFullPath = $imagePath . $imageName;

    // Move the uploaded image to the specified folder
    move_uploaded_file($imageTemp, $imageFullPath);

    // Update the admin's information in the database
    $updateSql = "UPDATE employee SET first_name = :firstName, last_name = :lastName, department = :department, 
                  position = :position, password = :password, images = :images WHERE email = :email";
    $stmt = $conn->prepare($updateSql);
    $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $stmt->bindParam(':department', $department, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':images', $imageFullPath, PDO::PARAM_STR);
    $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Profile updated successfully";
    } else {
        $imageUrl = $_POST['currentProfileImageInput'];
    }

    $stmt->closeCursor();
} else {
    echo "Invalid request";
}
?>