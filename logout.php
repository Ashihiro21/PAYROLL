<?php
session_start();

// Check if the admin is logged in
if (isset($_SESSION['username']) && $_SESSION['username'] === true) {
    // Unset admin session variables
    unset($_SESSION['username']);
    // Destroy admin session
    session_destroy();
}

// Redirect to login page
header("Location: index.php");
exit;
?>