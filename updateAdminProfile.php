<?php
include("conn.php");

$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$fullname = $_REQUEST["fullname"];

$sql_update_users = "UPDATE users SET password='$password', fullname='$fullname' WHERE username='$username'";

$conn->query($sql_update_users);
?>
