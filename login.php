<?php

include("conn.php");
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

//$password = md5($password);

$sql = "select * from users where username = '$username' and password = '$password'";

$result = $conn->query($sql);
if($result->num_rows > 0){

    $values = $result->fetch_assoc();
    if($values["userType"]=="Admin"){
        header('location:index.php'); //-adminpage
        $_SESSION["username"] = $username;
        $_SESSION["userType"] = $values['userType'];
    }else {
          header('location:index.php');
          $_SESSION["username"] = $username;
          $_SESSION["userType"] = $values['userType'];
        }

}else{
    echo '<script type="text/javascript">window.alert("Incorrect username or password. Please try again.");';
    echo 'window.location.href="index.php";</script>'; //instead header(); because unable to alert
}

$conn->close();
?>