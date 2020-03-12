<?php
include("conn.php");

$username = $_REQUEST["username"];
$fullname = $_REQUEST["fullname"];

if(strlen($_REQUEST["password"])>0){
  $password = md5($_REQUEST["password"]);
  $sql_update_users = "UPDATE users SET password='$password', fullname='$fullname' WHERE username='$username'";
}else{
  $sql_update_users = "UPDATE users SET fullname='$fullname' WHERE username='$username'";
}


$conn->query($sql_update_users);
?>
