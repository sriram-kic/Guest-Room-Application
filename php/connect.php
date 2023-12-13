<?php
// fetch items from the database and then display them
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cart";

$db = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>