<?php
session_start();
include_once('db_config.php');

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Fetch user data from the database
    $selectSql = "SELECT * FROM employee WHERE email = :email";
    $stmt = $conn->prepare($selectSql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    // Include image URL in the response
    if ($userData) {
        $userData['image_url'] = $userData['images'];
    }

    // Send user data as a JSON response
    header('Content-Type: application/json');
    echo json_encode($userData);
} else {
    // If the user is not logged in, return an empty JSON response
    echo json_encode([]);
}
?>
