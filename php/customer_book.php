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

    // Fetch user_id from rooms table
    $fetchUserIdStmt = $db->prepare("SELECT user_id FROM rooms WHERE room_number = ?");
    $fetchUserIdStmt->bind_param("s", $room_number);

    if (!$fetchUserIdStmt->execute()) {
        echo json_encode(['success' => false, 'message' => 'Error fetching user_id. Please try again.']);
        exit;
    }

    $fetchUserIdResult = $fetchUserIdStmt->get_result();

    if ($fetchUserIdResult->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'User not found for room number ' . $room_number]);
        exit;
    }

    $fetchUserIdRow = $fetchUserIdResult->fetch_assoc();
    $owner_id = $fetchUserIdRow['user_id'];

    $fetchUserIdStmt->close();

    // Insert into bookings table
    $stmt = $db->prepare("INSERT INTO bookings (user_id, owner_id, room_number, checkin_date, checkout_date, adults, children, property_name, customer_name, customer_email, customer_phone, booking_date, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'Booked')");

    $stmt->bind_param("sssssssssss", $user_id, $owner_id, $room_number, $checkin_date, $checkout_date, $adults, $children, $property_name, $customer_name, $customer_email, $customer_phone);

    if ($stmt->execute()) {
        // Update status in the rooms table
        $updateStatusStmt = $db->prepare("UPDATE rooms SET status = 'Booked' WHERE room_number = ?");
        $updateStatusStmt->bind_param("s", $room_number);

        if (!$updateStatusStmt->execute()) {
            echo json_encode(['success' => false, 'message' => 'Error updating room status. Please try again.']);
            exit;
        }

        $updateStatusStmt->close();

        echo json_encode(['success' => true, 'message' => 'Booking submitted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error submitting booking. Please try again.']);
    }

    $stmt->close();
    $db->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Form not submitted']);
}
?>
