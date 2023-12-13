
<?php
include "connect.php";
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['login'])) {
    header('Location: register.html');
    exit();
} else {
    // User is logged in, retrieve user information
    $id = $_SESSION['id']; // User ID
    $role = $_SESSION['role']; // User's role
}

function isUserLoggedIn($userId) {
    // Check if the provided user ID matches the logged-in user ID
    return isset($_SESSION['login']) && $_SESSION['id'] == $userId;
}
?>
