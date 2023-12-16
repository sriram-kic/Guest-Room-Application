<?php

include "connect.php";

// Retrieve data from the AJAX request
$roomId = $_POST['room_id'];
$customerName = $_POST['customer_name'];
$customerEmail = $_POST['customer_email'];
$customerPhone = $_POST['customer_phone'];

// Update the room status to 'Booked'
$updateSql = "UPDATE rooms SET status = 'Booked' WHERE room_id = $roomId";

if ($db->query($updateSql) === TRUE) {
    // Insert booking details into the bookings table
    $insertSql = "INSERT INTO bookings (room_id, customer_name, customer_email, customer_phone) 
                  VALUES ($roomId, '$customerName', '$customerEmail', '$customerPhone')";

    if ($db->query($insertSql) === TRUE) {
        echo "Room booked successfully!";
    } else {
        echo "Error booking room: " . $db->error;
    }
} else {
    echo "Error updating room status: " . $db->error;
}

$db->close();

?>
