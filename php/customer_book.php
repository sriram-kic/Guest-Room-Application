<?php

include "connect.php";
include "session.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

    $property_name = $db->real_escape_string($_POST['property_name']);
    $room_number = $db->real_escape_string($_POST['room_number']);
    $customer_name = $db->real_escape_string($_POST['customer_name']);
    $customer_email = $db->real_escape_string($_POST['customer_email']);
    $customer_phone = $db->real_escape_string($_POST['customer_phone']);
    $checkin_date = $db->real_escape_string($_POST['checkin_date']);
    $checkout_date = $db->real_escape_string($_POST['checkout_date']);
    $adults = $db->real_escape_string($_POST['adults']);
    $children = $db->real_escape_string($_POST['children']);

    // Begin a transaction to ensure both insert and update are successful or none
    $db->begin_transaction();

    try {
        // Insert into bookings table
        $stmt = $db->prepare("INSERT INTO bookings (user_id, room_number, checkin_date, checkout_date, adults, children, property_name, customer_name, customer_email, customer_phone, booking_date, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'booked')");

        $stmt->bind_param("ssssssssss", $user_id, $room_number, $checkin_date, $checkout_date, $adults, $children, $property_name, $customer_name, $customer_email, $customer_phone);

        if (!$stmt->execute()) {
            throw new Exception('Error inserting into bookings table');
        }

        $stmt->close();

        // Update the status in the rooms table
        $updateStmt = $db->prepare("UPDATE rooms SET status = 'booked' WHERE room_number = ?");
        $updateStmt->bind_param("s", $room_number);

        if (!$updateStmt->execute()) {
            throw new Exception('Error updating room status');
        }

        $updateStmt->close();

        // Commit the transaction if everything is successful
        $db->commit();

        echo json_encode(['success' => true, 'message' => 'Booking submitted successfully']);
    } catch (Exception $e) {
        // Rollback the transaction if there is an error
        $db->rollback();

        echo json_encode(['success' => false, 'message' => 'Error submitting booking. Please try again.']);
    }

    $db->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Form not submitted']);
}

?>
