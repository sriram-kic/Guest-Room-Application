<?php
include 'connect.php';

// Check if room_id and updated_data are set in the POST request
if (isset($_POST['room_id']) && isset($_POST['updated_data'])) {
    $room_id = $_POST['room_id'];
    $updated_data = $_POST['updated_data'];

    // Use prepared statements to prevent SQL injection
    $query = "UPDATE rooms SET
                property_name = ?,
                room_number = ?,
                room_type = ?,
                num_of_beds = ?,
                floor_size_sqft = ?,
                min_booking_period = ?,
                max_booking_period = ?,
                rent_per_day = ?,
                address = ?,
                city = ?,
                country = ?,
                contact_name = ?,
                contact_email = ?,
                contact_phone = ?,
                additional_details = ?
            WHERE id = ?";

    $stmt = $db->prepare($query);
    if ($stmt === false) {
        $response['success'] = false;
        $response['error'] = $db->error;
        echo json_encode($response);
        exit;
    }
    $stmt->bind_param(
        'ssssssssssssssss', // Update format string if needed
        $updated_data['property_name'],
        $updated_data['room_number'],
        $updated_data['room_type'],
        $updated_data['num_of_beds'],
        $updated_data['floor_size_sqft'], 
        $updated_data['min_booking_period'],
        $updated_data['max_booking_period'],
        $updated_data['rent_per_day'],
        $updated_data['address'],
        $updated_data['city'],
        $updated_data['country'],
        $updated_data['contact_name'],
        $updated_data['contact_email'],
        $updated_data['contact_phone'],
        $updated_data['additional_details'],
        $room_id
    );
    

    // Execute the update query
    $result = $stmt->execute();

    // Check if the query was successful
    if ($result) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $db->close();

    // Return the response as JSON
    echo json_encode($response);
} else {
    // If room_id or updated_data is not set, return an error response
    $response['success'] = false;
    $response['error'] = 'Invalid request parameters';
    echo json_encode($response);
}
?>
