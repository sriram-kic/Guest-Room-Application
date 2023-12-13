<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the room ID from the POST data
    $roomId = $_POST['room_id'];

    // Retrieve other fields from the POST data
    $property_name = $_POST['property_name'];
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $num_of_beds = $_POST['num_of_beds'];
    $floor_size_sqft = $_POST['floor_size_sqft'];
    $min_booking_period = $_POST['min_booking_period'];
    $max_booking_period = $_POST['max_booking_period'];
    $rent_per_day = $_POST['rent_per_day'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $amenities = implode(', ', $_POST['amenities']); // Convert array to string
    $additional_details = $_POST['additional_details'];

    // Update the room details in the database
    $sql = "UPDATE rooms SET 
            property_name = '$property_name',
            room_number = '$room_number',
            room_type = '$room_type',
            num_of_beds = '$num_of_beds',
            floor_size_sqft = '$floor_size_sqft',
            min_booking_period = '$min_booking_period',
            max_booking_period = '$max_booking_period',
            rent_per_day = '$rent_per_day',
            address = '$address',
            city = '$city',
            country = '$country',
            contact_name = '$contact_name',
            contact_email = '$contact_email',
            contact_phone = '$contact_phone',
            amenities = '$amenities',
            additional_details = '$additional_details'
            WHERE id = $roomId"; // Update this query based on your actual table structure

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    // Close the database connection
    $conn->close();
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
