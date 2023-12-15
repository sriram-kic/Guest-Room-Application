<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emailOrMobile = $_POST['emailOrMobile'];

    // Check if the input is a valid email
    if (filter_var($emailOrMobile, FILTER_VALIDATE_EMAIL)) {
        try {
            // Check if the email exists in the database
            $check_query = 'SELECT * FROM users WHERE email = ?';
            $check_stmt = $db->prepare($check_query);
            $check_stmt->bind_param('s', $emailOrMobile); // 's' represents a string, adjust accordingly
            $check_stmt->execute();

            $check_stmt->store_result();

            if ($check_stmt->num_rows === 1) {
                // Email exists, generate reset token and update the database
                $password_reset_token = bin2hex(random_bytes(16));
                $password_reset_token = htmlspecialchars($password_reset_token);
                $update_query = 'UPDATE users SET password_reset_token = ?, password_reset_token = DATE_ADD(NOW(), INTERVAL 1 DAY) WHERE email = ?';
                $stmt = $db->prepare($update_query);
                $stmt->bind_param('ss', $password_reset_token, $emailOrMobile); // 'ss' represents two strings, adjust accordingly
                $stmt->execute();

                // Email sending logic (assuming email is used for password reset)
                $to = $emailOrMobile; // Use email directly
                $subject = 'Password Reset Link';
                $message = 'Your password reset link: https://example.com/reset-password?token=' . $password_reset_token;
                $headers = 'From: your_email@example.com' . "\r\n" .
                    'Reply-To: your_email@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                if (mail($to, $subject, $message, $headers)) {
                    echo 'success';
                } else {
                    echo 'email_failed';
                }
            } else {
                echo 'email_not_found';
            }
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    } else {
        echo 'invalid_input';
    }
}
?>
