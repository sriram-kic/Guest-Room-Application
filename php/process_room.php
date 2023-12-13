<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $property_name = $_POST["property_name"];
    $room_number = $_POST["room_number"];
    $room_type = $_POST["room_type"];
    $num_of_beds = $_POST["num_of_beds"];
    $floor_size_sqft = $_POST["floor_size"];
    $min_booking_period = $_POST["min_booking_period"];
    $max_booking_period = $_POST["max_booking_period"];
    $rent_per_day = $_POST["rent_per_day"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $contact_name = $_POST["contact_name"];
    $contact_email = $_POST["contact_email"];
    $contact_phone = $_POST["contact_phone"];
    $amenities = implode(", ", $_POST["amenities"]);
    $additional_details = $_POST["additional_details"];
    $target_dir = "../uploads/";
    $uploaded_files = [];
    foreach ($_FILES["photo_upload"]["name"] as $index => $file_name) {
        $target_file = $target_dir . basename($file_name);

        if (move_uploaded_file($_FILES["photo_upload"]["tmp_name"][$index], $target_file)) {
            $uploaded_files[] = $target_file;
        } else {
            echo "Error uploading file: $file_name<br>";
            error_log("Error uploading file: $file_name");
        }
    }

    $photo_paths = implode(",", $uploaded_files);

    $stmt = $db->prepare("INSERT INTO rooms (property_name,room_number, room_type, num_of_beds, floor_size_sqft, min_booking_period, max_booking_period, rent_per_day, address, city, country, contact_name, contact_email, contact_phone, amenities, additional_details, photo_paths) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssssssssssss", $property_name,$room_number, $room_type, $num_of_beds, $floor_size_sqft, $min_booking_period, $max_booking_period, $rent_per_day, $address, $city, $country, $contact_name, $contact_email, $contact_phone, $amenities, $additional_details, $photo_paths);

    if ($stmt->execute()) {
        echo "Room added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $db->close();
}
?>