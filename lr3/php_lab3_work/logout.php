<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Delete the cookie
setcookie('username', '', time() - 3600, "/"); // Set cookie expiration time in the past to delete it

// Redirect to the login page
header("Location: login.php");
exit;
?>
