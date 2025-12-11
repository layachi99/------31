<?php

session_start();

$valid_login = 'admin';
$valid_password = 'password123';

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: session_version.php');
    exit;
}

$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$username = $_SESSION['username'] ?? '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($login === $valid_login && $password === $valid_password) {
        $_SESSION['username'] = $login;
        $_SESSION['logged_in'] = true;
        header('Location: session_version.php');
        exit;
    } else {
        $error = 'Wrong username or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Version</title>
</head>
<body>
    <h1>Session</h1>
    
    <?php if ($is_logged_in): ?>
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>You are logged in using sessions.</p>
        <p><a href="session_version.php?logout=1">Logout</a></p>
        
    <?php else: ?>
        <h2>Login Form</h2>
        
        <form method="POST" action="">
            <div>
                <strong>Username</strong><br>
                <input type="text" name="login" placeholder="Enter username" required>
            </div>
            
            <div>
                <strong>Password</strong><br>
                <input type="password" name="password" placeholder="Enter password" required>
            </div>
            
            <p><strong>Demo credentials:</strong><br>
            Username: admin<br>
            Password: password123</p>
            
            <hr>
            
            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            
            <button type="submit">Login</button>
        </form>
    <?php endif; ?>
</body>
</html>