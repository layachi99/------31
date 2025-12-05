<?php
// Hardcoded username and password (for demo purposes)
$valid_username = "user123";
$valid_password = "password123";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the entered credentials match the valid ones
    if ($username == $valid_username && $password == $valid_password) {
        // Set session variables
        session_start();
        $_SESSION['username'] = $username;

        // Optionally set a cookie to remember the user for 1 hour (3600 seconds)
        setcookie('username', $username, time() + 3600, "/"); // expires in 1 hour

        // Redirect to a welcome page
        header("Location: welcome.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>

