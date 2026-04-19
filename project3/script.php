
<?php
require 'config.php';

$username = 'admin';
$plain_password = 'admin123';
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

try {
    // Check if user already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        // Update existing user
        $update = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
        $update->execute([$hashed_password, $username]);
        echo "✅ Admin user UPDATED with username 'admin' and password 'admin123'.<br>";
    } else {
        // Insert new user
        $insert = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert->execute([$username, $hashed_password]);
        echo "✅ Admin user CREATED with username 'admin' and password 'admin123'.<br>";
    }
    echo "<a href='login.php'>Go to Admin Login</a>";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>