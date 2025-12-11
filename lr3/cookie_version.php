<?php

$valid_login = 'admin';
$valid_password = 'password123';

if (isset($_GET['logout'])) {
    setcookie('username', '', time() - 3600, '/');
    setcookie('logged_in', '', time() - 3600, '/');
    header('Location: cookie_version.php');
    exit;
}

$is_logged_in = isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] === 'true';
$username = $_COOKIE['username'] ?? '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($login === $valid_login && $password === $valid_password) {
        setcookie('username', $login, time() + 3600, '/');
        setcookie('logged_in', 'true', time() + 3600, '/');
        header('Location: cookie_version.php');
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
    <title>Cookie Version</title>
</head>
<body>
    <h1>Cookie</h1>
    
    <?php if ($is_logged_in): ?>
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>You are logged in using cookies.</p>
        <p><a href="cookie_version.php?logout=1">Logout</a></p>
        
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