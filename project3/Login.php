<?php
session_start();
require 'config.php';

if ($_POST) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['admin'] = true;
        header("Location: view_orders.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Ebenezer Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <div class="logo">🏨 Ebenezer Hotel</div>
    <div class="nav-links">
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="menu.html">Menu</a>
        <a href="gallery.html">Gallery</a>
        <a href="order.php">Order</a>
        <a href="contact.php">Contact</a>
    </div>
</div>

<div class="login-card">
    <h2 style="text-align:center;">Admin Login</h2>
    <?php if (isset($error)) echo "<div class='message error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn" style="width:100%;">Login</button>
    </form>
    <p style="text-align:center; margin-top:15px;">Demo: admin / password</p>
</div>

<div class="footer">
    <p>© 2026 Ebenezer Hotel</p>
</div>

</body>
</html>