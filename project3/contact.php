<?php
require 'config.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($full_name) || empty($email) || empty($location) || empty($message)) {
        $error = 'Please fill in all required fields (*).';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (full_name, email, phone, location, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$full_name, $email, $phone, $location, $message]);
            $success = true;
            // Clear POST data to avoid resubmission on refresh
            $_POST = [];
        } catch (PDOException $e) {
            $error = 'Something went wrong. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Ebenezer Hotel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional contact page styling */
        .contact-hero {
            background: linear-gradient(135deg, #f4efe7 0%, #fff7ed 100%);
            padding: 2rem 1rem;
            text-align: center;
            border-bottom: 2px solid #ffd966;
        }
        .contact-hero h1 {
            font-size: 2.2rem;
            color: #3b5c3a;
        }
        .contact-hero p {
            color: #7c6b4f;
            margin-top: 0.5rem;
        }
        .contact-card {
            background: white;
            border-radius: 32px;
            box-shadow: 0 20px 35px -12px rgba(0,0,0,0.1);
            padding: 2rem 1.8rem;
            max-width: 680px;
            margin: 0 auto;
            border: 1px solid #fae6c3;
        }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px 16px;
            margin: 8px 0 16px 0;
            border: 1.5px solid #eee2d0;
            border-radius: 28px;
            background: #fefcf8;
            font-size: 1rem;
            transition: all 0.2s;
            font-family: inherit;
        }
        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: #ffb347;
            box-shadow: 0 0 0 3px rgba(255, 180, 71, 0.2);
            background: #fff;
        }
        .contact-form label {
            font-weight: 600;
            color: #4a5b3c;
            margin-left: 8px;
            display: block;
            font-size: 0.9rem;
        }
        .required-star {
            color: #e67e22;
        }
        .btn-submit {
            background: #ff9f4a;
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1rem;
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
            background: #e9f7e1;
            border-left: 6px solid #6fbf4c;
            padding: 1rem;
            border-radius: 60px;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2a5e2e;
        }
        .error-message {
            background: #ffe6e5;
            border-left: 6px solid #e67e22;
            padding: 1rem;
            border-radius: 60px;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #b85c00;
        }
        .contact-info {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #7a6a5a;
        }
        @media (max-width: 640px) {
            .contact-card { padding: 1.5rem; }
            .contact-hero h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🏨 Ebenezer Hotel</div>
    <div class="nav-links">
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="menu.html">Menu</a>
        <a href="gallery.html">Gallery</a>
        <a href="order.php">Order</a>
        <a href="contact.php" style="background:#5a7c5e; border-radius:5px;">Contact</a>
    </div>
</div>

<!-- CONTACT HEADER -->
<div class="contact-hero">
    <h1> Get in Touch</h1>
    <p>We’d love to hear from you – send us a message and we’ll reply within 24h</p>
</div>

<div class="container">
    <div class="contact-card">
        <?php if ($success): ?>
            <div class="success-message">
                ✨ Thank you! Your message has been sent. We'll get back to you soon.
            </div>
        <?php elseif ($error): ?>
            <div class="error-message">
                ⚠️ <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="contact-form">
            <label>Full name <span class="required-star">*</span></label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>" required>

            <label>Email address <span class="required-star">*</span></label>
            <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

            <label>Phone number</label>
            <input type="tel" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">

            <label>Location / City <span class="required-star">*</span></label>
            <input type="text" name="location" value="<?= htmlspecialchars($_POST['location'] ?? '') ?>" required>

            <label>Message <span class="required-star">*</span></label>
            <textarea name="message" rows="5" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>

            <button type="submit" class="btn-submit"> Send Message</button>
        </form>
        <div class="contact-info">
            📞 +250790784625 | ✉️ message@ebenezerhotel.com
        </div>
    </div>
</div>

<div class="footer">
    <p>© 2026 Ebenezer Hotel | TUYIZERE Elie</p>
</div>

</body>
</html>