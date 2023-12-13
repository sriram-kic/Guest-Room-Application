<?php
session_start();
include("connect.php");

if (isset($_POST['login'])) {
    $mail = $_POST['email'];
    $passw = $_POST['pass'];

    if (empty($mail) || empty($passw)) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Use prepared statements to prevent SQL injection
    $query = "SELECT id, role FROM users WHERE email = ? AND pass = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "ss", $mail, $passw);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    $count = mysqli_num_rows($query_run);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($query_run);
        $_SESSION['loggedin'] = true;
        $_SESSION['login_user'] = $row['id'];
        $_SESSION['user_role'] = $row['role'];

        $res = [
            'status' => 300,
            'message' => 'Login Successfully',
            'user_role' => $_SESSION['user_role']
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Username/Password wrong'
        ];
        echo json_encode($res);
        return;
    }
}

?>
