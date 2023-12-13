
<?php
include "session.php";

// Check if user with ID 123 is logged in
if (isUserLoggedIn(123)) {
    echo "User with ID 123 is logged in!";
} else {
    echo "User with ID 123 is not logged in!";
}
?>
