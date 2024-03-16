<?php
session_start();
include_once('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username'])) {
    // Validate and sanitize the input (add more validation as needed)
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    // Process and save the uploaded image
    $imagePath = 'img/'; // Specify the folder where you want to save the images
    $imageName = $_FILES['profileImage']['name'];
    $imageTemp = $_FILES['profileImage']['tmp_name'];
    $imageFullPath = $imagePath . $imageName;

    // Move the uploaded image to the specified folder
    move_uploaded_file($imageTemp, $imageFullPath);

    // Check if password is being changed
    if (!empty($_POST['password'])) {
        // Assuming you have a function to hash passwords for comparison
        $oldPassword = hash_function($_POST['password']); // Hash function should be replaced
        $checkPasswordSql = "SELECT password FROM admin WHERE username = :username";
        $stmt = $conn->prepare($checkPasswordSql);
        $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && password_verify($oldPassword, $result['password'])) {
            // Password is correct, proceed with the update
            // Update the admin's information in the database
            $updateSql = "UPDATE admin SET first_name = :firstName, last_name = :lastName, department = :department, 
                          position = :position, email = :email, images = :images WHERE username = :username";
            $stmt = $conn->prepare($updateSql);
            $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':department', $department, PDO::PARAM_STR);
            $stmt->bindParam(':position', $position, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':images', $imageFullPath, PDO::PARAM_STR);
            $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
            if ($stmt->execute()) {
                echo "Profile updated successfully";
            } else {
                echo "Failed to update profile";
            }
            $stmt->closeCursor();
        } else {
            // Password is incorrect, logout the user
            session_destroy();
            header("Location: logout.php"); // Redirect to logout script
            exit();
        }
    } else {
        // Password is not being changed, proceed with the update
        $updateSql = "UPDATE admin SET first_name = :firstName, last_name = :lastName, department = :department, 
                      position = :position, email = :email, images = :images WHERE username = :username";
        $stmt = $conn->prepare($updateSql);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':department', $department, PDO::PARAM_STR);
        $stmt->bindParam(':position', $position, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':images', $imageFullPath, PDO::PARAM_STR);
        $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            echo "Profile updated successfully";
        } else {
            echo "Failed to update profile";
        }
        $stmt->closeCursor();
    }
} else {
    echo "Invalid request";
}
?>
