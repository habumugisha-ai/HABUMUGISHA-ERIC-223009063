<?php
require 'config.php'; // database connection

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and trim inputs
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $menu_item = trim($_POST['menu_item'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $order_date = trim($_POST['order_date'] ?? '');

    // Validation
    if (empty($full_name) || empty($email) || empty($phone) || empty($menu_item) || empty($address) || empty($order_date)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (!preg_match('/^[0-9+\-\s()]+$/', $phone)) {
        $error = 'Please enter a valid phone number.';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO orders (full_name, email, phone, menu_item, address, order_date) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$full_name, $email, $phone, $menu_item, $address, $order_date]);
            $success = true;
            // Clear POST data to avoid resubmission
            $_POST = [];
        } catch (PDOException $e) {
            $error = 'Database error: Unable to place order. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Food - Ebenezer Hotel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional order page styling */
        .order-container {
            max-width: 720px;
            margin: 2rem auto;
            background: #fffef7;
            border-radius: 32px;
            box-shadow: 0 20px 35px -12px rgba(0,0,0,0.1);
            padding: 2rem 2rem 2.5rem;
            border: 1px solid #f0e2cf;
        }
        .order-container h1 {
            text-align: center;
            color: #3b5c3a;
            margin-bottom: 0.5rem;
            font-size: 2rem;
        }
        .order-container p {
            text-align: center;
            color: #7a684e;
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.2rem;
        }
        label {
            display: block;
            font-weight: 600;
            color: #4a5b3c;
            margin-bottom: 6px;
        }
        .required {
            color: #e67e22;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e6dbc9;
            border-radius: 28px;
            background: #fefcf8;
            font-size: 1rem;
            transition: 0.2s;
            font-family: inherit;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #ffb347;
            box-shadow: 0 0 0 3px rgba(255, 180, 71, 0.2);
        }
        .btn-submit {
            background: #ff9f4a;
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            width: 100%;
            transition: 0.2s;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background: #e8882e;
            transform: translateY(-2px);
        }
        .success-message {
            background: #e0f2e0;
            border-left: 6px solid #2e7d32;
            padding: 1rem;
            border-radius: 60px;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #1f4f1f;
        }
        .error-message {
            background: #ffe0db;
            border-left: 6px solid #e67e22;
            padding: 1rem;
            border-radius: 60px;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #b85c00;
        }
        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            text-align: center;
            width: 100%;
            color: #ff9800;
            text-decoration: none;
        }
        @media (max-width: 640px) {
            .order-container {
                padding: 1.5rem;
                margin: 1rem;
            }
        }
    </style>
</head>
<body>

<!-- NAVBAR (same as index) -->
<div class="navbar">
    <div class="logo">🏨 Ebenezer Hotel</div>
    <div class="nav-links">
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="menu.html">Menu</a>
        <a href="gallery.html">Gallery</a>
        <a href="order.php" style="background:#5a7c5e; border-radius:5px;">Order</a>
        <a href="contact.php">Contact</a>
    </div>
</div>

<div class="order-container">
    <h1>📋 Place Your Order</h1>
    <p>Freshly prepared meals delivered to your doorstep</p>

    <?php if ($success): ?>
        <div class="success-message">
            ✅ Thank you! Your order has been placed successfully. We'll contact you shortly.
        </div>
    <?php elseif ($error): ?>
        <div class="error-message">
            ⚠️ <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Full Name <span class="required">*</span></label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Email <span class="required">*</span></label>
            <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Phone Number <span class="required">*</span></label>
            <input type="tel" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label>Select Menu Item <span class="required">*</span></label>
            <select name="menu_item" required>
                <option value="" disabled selected>— Choose a delicious dish —</option>
                <option value="Grilled Fish" <?= (($_POST['menu_item'] ?? '') == 'Grilled Fish') ? 'selected' : '' ?>>🐟 Grilled Fish – $10</option>
                <option value="Fried Fish" <?= (($_POST['menu_item'] ?? '') == 'Fried Fish') ? 'selected' : '' ?>>🐟 Fried Fish – $12</option>
                <option value="Soda" <?= (($_POST['menu_item'] ?? '') == 'Soda') ? 'selected' : '' ?>>🥤 Soda – $5</option>
                <option value="Milkshake" <?= (($_POST['menu_item'] ?? '') == 'Milkshake') ? 'selected' : '' ?>>🥛 Milkshake – $6</option>
                <option value="Orange Juice" <?= (($_POST['menu_item'] ?? '') == 'Orange Juice') ? 'selected' : '' ?>>🍊 Orange Juice – $3</option>
                <option value="Mango Juice" <?= (($_POST['menu_item'] ?? '') == 'Mango Juice') ? 'selected' : '' ?>>🥭 Mango Juice – $4</option>
            </select>
        </div>

        <div class="form-group">
            <label>Delivery Address <span class="required">*</span></label>
            <textarea name="address" rows="3" required><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label>Preferred Delivery Date <span class="required">*</span></label>
            <input type="date" name="order_date" value="<?= htmlspecialchars($_POST['order_date'] ?? '') ?>" required>
        </div>

        <button type="submit" class="btn-submit">🍽️ Confirm Order</button>
    </form>
    <a href="menu.html" class="back-link">← Browse our full menu</a>
</div>

<div class="footer">
    <p>© 2026 Ebenezer Hotel | Fresh food, warm hospitality</p>
</div>

</body>
</html>