<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="container">
<h2>Admin Dashboard</h2>

<div class="card">
<h3>Customer Orders</h3>

<table>
<tr>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Menu</th>
<th>Address</th>
<th>Date</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM orders");

while($row = $result->fetch_assoc()){
    echo "<tr>
    <td>{$row['name']}</td>
    <td>{$row['email']}</td>
    <td>{$row['phone']}</td>
    <td>{$row['menu']}</td>
    <td>{$row['address']}</td>
    <td>{$row['date']}</td>
    </tr>";
}
?>

</table>

</div>

<a href="logout.php">Logout</a>
</div>
