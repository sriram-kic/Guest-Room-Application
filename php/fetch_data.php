<?php
include "connect.php";
include "session.php";


$id = $_SESSION['login_user'];
$query = "SELECT * FROM rooms WHERE user_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Add each row as an array to $data
    }
}

// Set the appropriate header for JSON response
header('Content-Type: application/json');

// Output the JSON data
echo json_encode(array('data' => $data));

// Close the database connection
$stmt->close();
$db->close();
?>
