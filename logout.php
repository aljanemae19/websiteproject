<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or another destination
header("Location: mywebsite/index.html"); // Replace "login.php" with the actual URL you want to redirect to
exit;
?>
