<?php
include 'db.php';

$sql = "INSERT INTO contact (name,email,phone,location,message)
VALUES (
'$_POST[name]',
'$_POST[email]',
'$_POST[phone]',
'$_POST[location]',
'$_POST[message]'
)";

$conn->query($sql);

echo "Message Sent!";
?>
