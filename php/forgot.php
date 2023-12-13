<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emailOrMobile = $_POST['emailOrMobile'];

    // Check if the input is a valid email or a mobile number (you may need more robust validation)
    if (filter_var($emailOrMobile, FILTER_VALIDATE_EMAIL) || preg_match('/^\d{10}$/', $emailOrMobile)) {
        try {
            // Check if the email or mobile number exists in the database
            $check_query = 'SELECT * FROM users WHERE email = :user_email OR mobile = :user_mobile';
            $check_stmt = $db->prepare($check_query);
            $check_stmt->bindParam(':user_email', $emailOrMobile, PDO::PARAM_STR);
            $check_stmt->bindParam(':user_mobile', $emailOrMobile, PDO::PARAM_STR);
            $check_stmt->execute();

            if ($check_stmt->rowCount() === 1) {
                // Email or mobile number exists, generate reset token and update the database
                $password_reset_token = bin2hex(random_bytes(16));
                $password_reset_token = htmlspecialchars($password_reset_token);
                $update_query = 'UPDATE users SET password_reset_token = :reset_token, password_reset_expires = DATE_ADD(NOW(), INTERVAL 1 DAY) WHERE email = :update_email OR mobile = :update_mobile';
                $stmt = $db->prepare($update_query);
                $stmt->bindParam(':reset_token', $password_reset_token, PDO::PARAM_STR);
                $stmt->bindParam(':update_email', $emailOrMobile, PDO::PARAM_STR);
                $stmt->bindParam(':update_mobile', $emailOrMobile, PDO::PARAM_STR);
                $stmt->execute();

                // Email sending logic (assuming email is used for password reset)
                $to = ''; // Set the email to send the reset link to
                // Retrieve the email from the database based on $emailOrMobile
                // Assuming you have a column named 'email' in your 'users' table
                $email_query = 'SELECT email FROM users WHERE email = :email OR mobile = :mobile';
                $email_stmt = $db->prepare($email_query);
                $email_stmt->bindParam(':email', $emailOrMobile, PDO::PARAM_STR);
                $email_stmt->bindParam(':mobile', $emailOrMobile, PDO::PARAM_STR);
                $email_stmt->execute();

                if ($email_stmt->rowCount() === 1) {
                    $row = $email_stmt->fetch(PDO::FETCH_ASSOC);
                    $to = $row['email'];
                }
                if (!empty($to)) {
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
            } else {
                echo 'not_found';
            }
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    } else {
        echo 'invalid_input';
    }
}
?>
