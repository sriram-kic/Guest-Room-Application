<?php

include("config.php");

$filePath = $_GET['file'];

if (file_exists($filePath)) {
    $fileInfo = pathinfo($filePath);
    $fileExtension = $fileInfo['extension'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileExtension, $allowedExtensions)) {
        header('Content-Type: image/' . $fileExtension);
        readfile($filePath);
        exit;
    }
}

// Error image or placeholder if the file is not found or doesn't have an allowed extension
header('Content-Type: image/png'); // Set the content type for the error image
readfile('path_to_error_image.png'); // Provide a path to an error image or a placeholder
exit;
?>
