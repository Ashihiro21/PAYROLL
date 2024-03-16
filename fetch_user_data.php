<?php
session_start();
include_once('db_config.php');

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch user data from the database
    $selectSql = "SELECT * FROM admin WHERE username = :username";
    $stmt = $conn->prepare($selectSql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
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
