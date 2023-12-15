<?php

include "connect.php";

// Check if room_id is provided
if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];


    // Prepare and execute the SQL query
    $sql = "SELECT * FROM rooms WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $room_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Return JSON response
        if ($row) {
            $response = ['success' => true, 'data' => $row];
        } else {
            $response = ['success' => false, 'error' => 'Room not found'];
        }
    } else {
        $response = ['success' => false, 'error' => 'Error executing query'];
    }

    // Close the database dbection
    $stmt->close();
    $db->close();
} else {
    $response = ['success' => false, 'error' => 'Room ID not provided'];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
