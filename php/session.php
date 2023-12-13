<?php
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['login'])) {
    header('Location: register.html');
    exit();
} else {
    // User is logged in, retrieve user information
    $username = $_SESSION['login_user']; // Username
    $role = $_SESSION['role']; // User's role
}
// Use $username and $role as needed in your code...
?>
