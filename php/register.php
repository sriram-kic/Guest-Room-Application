<?php
include("config.php");

if (isset($_POST['ownerSignupForm']) || isset($_POST['customerSignupForm'])) {
    include("config.php");
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);
    $cpass = mysqli_real_escape_string($db, $_POST['cpass']);
    $contact = mysqli_real_escape_string($db, $_POST['contact']);
    $role = ''; // Initialize role variable

    // Validation for mandatory fields
    if (empty($email) || empty($pass) || empty($contact) || empty($cpass)) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $res = [
            'status' => 422,
            'message' => 'Invalid email format'
        ];
        echo json_encode($res);
        return;
    }

    // Check if passwords match
    if ($pass != $cpass) {
        $res = [
            'status' => 500,
            'message' => 'Passwords do not match'
        ];
        echo json_encode($res);
        return;
    }

// Check if the email or contact already exists
$query_check_existing = "SELECT * FROM users WHERE email = ? OR contact = ?";
$stmt_check_existing = mysqli_prepare($db, $query_check_existing);
mysqli_stmt_bind_param($stmt_check_existing, "ss", $email, $contact);
mysqli_stmt_execute($stmt_check_existing);
mysqli_stmt_store_result($stmt_check_existing);

if (mysqli_stmt_num_rows($stmt_check_existing) > 0) {
    $res = [
        'status' => 500,
        'message' => 'User with this email or mobile number already exists'
    ];
    echo json_encode($res);
    return;
}

    // Assign role based on form submission
    if (isset($_POST['ownerSignupForm'])) {
        $role = 'OWNER';
    } elseif (isset($_POST['customerSignupForm'])) {
        $role = 'CUSTOMER';
    }

    // Prepare and execute the SQL statement using prepared statements for insertion
    $query_insert = "INSERT INTO users (email, pass, contact, role) VALUES (?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($db, $query_insert);

    // Bind parameters and execute the statement for insertion
    mysqli_stmt_bind_param($stmt_insert, "ssss", $email, $pass, $contact, $role);
    $success = mysqli_stmt_execute($stmt_insert);

    if ($success) {
        $res = [
            'status' => 200,
            'message' => 'Registration successful'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Server Error. Registration Failed'
        ];
        echo json_encode($res);
        return;
    }
}
?>
