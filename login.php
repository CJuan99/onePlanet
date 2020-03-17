<?php

include("conn.php");
session_start();

$username = $_GET['username'];
$password = $_GET['password'];

$password = md5($password);

$sql = "select * from users where username = '$username' and password = '$password'";

$result = $conn->query($sql);
if($result->num_rows > 0){
    $values = $result->fetch_assoc();
    if($values["userType"]=="Admin"){
        //header('location:maintainMaterial.php');
        $_SESSION["username"] = $username;
        $_SESSION["userType"] = $values['userType'];
        echo true;
        echo ",".$values['userType'];
    }elseif($values["userType"]=="Recycler") {
          //header('location:index.php');
          $_SESSION["username"] = $username;
          $_SESSION["userType"] = $values['userType'];
          echo true;
          echo ",".$values['userType'];
    }else {
          //header('location:index.php');
          $_SESSION["username"] = $username;
          $_SESSION["userType"] = $values['userType'];
          echo true;
          echo ",".$values['userType'];
        }
}else{
    echo false;
    echo ",Nothing";
}

$conn->close();
?>
