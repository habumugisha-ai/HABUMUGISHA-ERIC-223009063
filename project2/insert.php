<?php
include "db.php";

$firstname = $_POST['firstname'];
$lastname  = $_POST['lastname'];
$email     = $_POST['email'];
$mobile    = $_POST['mobile'];
$gender    = $_POST['gender'];
$address   = $_POST['address'];
$city      = $_POST['city'];
$pincode   = $_POST['pincode'];
$state     = $_POST['state'];
$country   = $_POST['country'];
$course    = $_POST['course'];

$sql = "INSERT INTO students 
(firstname, lastname, email, mobile, gender, address, city, pincode, state, country, course)
VALUES 
('$firstname', '$lastname', '$email', '$mobile', '$gender', '$address', '$city', '$pincode', '$state', '$country', '$course')";

if (mysqli_query($conn, $sql)) {
    echo "<h2>✅ Data saved successfully!</h2>";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}
?>
