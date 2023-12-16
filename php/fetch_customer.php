<?php
include "connect.php";

// Fetch room details from the database based on the selected date
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedDate = $_POST['date'];

    // Implement your query to fetch room details from the database
    $query = "SELECT 
                property_name, room_number, room_type, num_of_beds, floor_size_sqft, min_booking_period, max_booking_period, rent_per_day,
                address, city, country, contact_name, contact_email, contact_phone,
                amenities, additional_details, photo_paths, status
              FROM rooms
              WHERE status = 'Available'";

    $result = $db->query($query);

    $roomDetails = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $roomDetails[] = [
                'property_name' => $row['property_name'],
                'room_number' => $row['room_number'],
                'room_type' => $row['room_type'],
                'num_of_beds' => $row['num_of_beds'],
                'floor_size_sqft' => $row['floor_size_sqft'],
                'min_booking_period' => $row['min_booking_period'],
                'max_booking_period' => $row['max_booking_period'],
                'rent_per_day' => $row['rent_per_day'],
                'address' => $row['address'],
                'city' => $row['city'],
                'country' => $row['country'],
                'contact_name' => $row['contact_name'],
                'contact_email' => $row['contact_email'],
                'contact_phone' => $row['contact_phone'],
                'amenities' => $row['amenities'],
                'additional_details' => $row['additional_details'],
                'photo_paths' => $row['photo_paths']
            ];
        }
    }

    echo json_encode($roomDetails);
}

$db->close();
?>
