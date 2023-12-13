<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomId = $_POST["room_id"];
    // Get other edited details from the form fields
    
    $stmt = $db->prepare("UPDATE rooms SET /* Update columns based on your database schema */ WHERE id = ?");
    $stmt->bind_param("i", $roomId);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Error updating room"]);
    }
    
    $stmt->close();
    $db->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
