<?php
session_start();

// Check if the user is logged in through session or cookie
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} elseif (isset($_COOKIE['username'])) {
    // If session is not set, check the cookie
    $username = $_COOKIE['username'];
} else {
    // If neither session nor cookie is set, redirect to the login page
    header("Location: login.php");
    exit;
}

echo "<h1>Welcome, $username!</h1>";
echo "<p>You are logged in.</p>";

// Provide a logout option
echo "<a href='logout.php'>Logout</a>";
?>
