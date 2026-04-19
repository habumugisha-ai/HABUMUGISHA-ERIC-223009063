<?php
session_start();
require 'config.php';

// Restrict access – only logged-in admins can view orders
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Fetch all orders from database (newest first)
$stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Customer Orders | Ebenezer Hotel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Admin panel specific styles */
        .admin-header {
            background: #2c3e2f;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .admin-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        .logout-btn {
            background: #e67e22;
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }
        .logout-btn:hover {
            background: #d35400;
            transform: scale(0.97);
        }
        .orders-container {
            overflow-x: auto;
            margin: 2rem 0;
        }
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .orders-table th {
            background: #3b5c3a;
            color: white;
            padding: 12px 10px;
            font-weight: 600;
        }
        .orders-table td {
            padding: 10px;
            border-bottom: 1px solid #f0e4d8;
            vertical-align: top;
        }
        .orders-table tr:hover {
            background: #fef9ef;
        }
        .empty-message {
            text-align: center;
            background: #fff7e8;
            padding: 2rem;
            border-radius: 28px;
            color: #8b765a;
            font-size: 1.1rem;
        }
        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #ff9800;
            text-decoration: none;
        }
        @media (max-width: 768px) {
            .orders-table th, .orders-table td {
                font-size: 0.8rem;
                padding: 8px 5px;
            }
            .admin-header {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<!-- Admin Navigation Bar -->
<div class="admin-header">
    <h2>🛡️ Admin Panel – Customer Orders</h2>
    <a href="logout.php" class="logout-btn">🚪 Logout</a>
</div>

<div class="container">
    <div class="orders-container">
        <?php if (count($orders) > 0): ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Menu Item</th>
                        <th>Address</th>
                        <th>Delivery Date</th>
                        <th>Order Placed</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['full_name']) ?></td>
                            <td><?= htmlspecialchars($order['email']) ?></td>
                            <td><?= htmlspecialchars($order['phone']) ?></td>
                            <td><?= htmlspecialchars($order['menu_item']) ?></td>
                            <td><?= htmlspecialchars($order['address']) ?></td>
                            <td><?= htmlspecialchars($order['order_date']) ?></td>
                            <td><?= htmlspecialchars($order['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-message">
                📭 No orders have been placed yet.<br>
                <a href="order.php" class="back-link">→ Go to Order Page ←</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="footer">
    <p>© 2026 Ebenezer Hotel | Secure Admin Area</p>
</div>

</body>
</html>