<?php

include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["roomId"])) {
    $roomId = $_POST["roomId"];

    // Perform deletion query based on room ID
    $deleteQuery = "DELETE FROM rooms WHERE id = ?";
    $stmt = $db->prepare($deleteQuery);
    $stmt->bind_param("i", $roomId);

    if ($stmt->execute()) {
        echo "Room deleted successfully!";
    } else {
        echo "Error deleting room: " . $stmt->error;
    }

    $stmt->close();
    $db->close();
}
?>
