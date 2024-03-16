<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['email']) && $_SESSION['email'] === true) {
    // Unset user session variables
    unset($_SESSION['email']);
    // Destroy user session
    session_destroy();
}

// Redirect to login page
header("Location: index.php");
exit;
?>
