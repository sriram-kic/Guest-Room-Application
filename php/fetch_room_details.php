<?php

include("connect.php");

if (isset($_GET['room_id'])) {
    $roomId = $_GET['room_id'];

    // Fetch data for a specific room
    $query = "SELECT * FROM rooms WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $roomId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Set the appropriate header for JSON response
        header('Content-Type: application/json');

        // Output the JSON data
        echo json_encode(['success' => true, 'data' => $row]);
    } else {
        // Set the appropriate header for JSON response
        header('Content-Type: application/json');

        // Output an error message in JSON format
        echo json_encode(['success' => false, 'error' => 'Room data not found']);
    }
} else {
    // Set the appropriate header for JSON response
    header('Content-Type: application/json');

    // Output an error message in JSON format
    echo json_encode(['success' => false, 'error' => 'Room ID not provided']);
}

// Close the database connection
$stmt->close();
$db->close();
?>
