<?php
// Include your database configuration file
include "connect.php";


// Fetch data from the database
$query = "SELECT * FROM rooms";
$result = $db->query($query);


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
$db->close();
?>
