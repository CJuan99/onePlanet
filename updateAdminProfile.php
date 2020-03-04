<?php
include("conn.php");

$username = $_POST["username"];
$password = $_POST["password"];
$fullname = $_POST["fullname"];

$sql_update_users = "UPDATE users SET password='$password', fullname='$fullname' WHERE username='$username'";

$conn->query($sql_update_users);

echo '<script type="text/javascript">window.alert("Data saved successfully.");';
echo 'window.location.href="adminProfile.php";</script>';
?>
