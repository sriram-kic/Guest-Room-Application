
<?php
include "connect.php";
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php'); 
    exit();
} else{
    $id = $_SESSION['login_user']; 
    $role = $_SESSION['user_role']; 
// echo "Logged-in User ID: " . $id. "role is:" .$role;
}
?>
