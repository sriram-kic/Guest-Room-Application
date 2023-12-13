<?php
session_start();
$response = ['status' => 'failed']; 
if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    $_SESSION = array();

    if (session_destroy()) {
        $response['status'] = 'success';
    }
}
header('Content-Type: application/json');
echo json_encode($response);
?>
