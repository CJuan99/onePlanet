<?php
session_start();
  include("conn.php");

//if(isset($_GET["btnsubmitColl"])){

  $username = $_SESSION["username"];
  $fullname = $_REQUEST["fullname"];
  $password= $_REQUEST["password"];

	$password=md5($password);
  $sql_update = "UPDATE users SET fullname='$fullname' WHERE username= '$username'";

  $sql_updatePwd = "UPDATE users SET password='$password' WHERE username= '$username'";

//var_dump($_GET);
if($_REQUEST["password"]!="******"){
  if(strlen($_REQUEST["materialID"])>0){

    $matID = $_REQUEST["materialID"];

    $sql_updateMat= "INSERT INTO registeredmaterial ( materialID, username) VALUES ( '$matID','$username')";

    if( $conn->query($sql_update) && $conn->query($sql_updatePwd) && $conn->query($sql_updateMat) ){
       echo true;
     }
     else{
       echo false;
     }

  }else{
    if( $conn->query($sql_update) && $conn->query($sql_updatePwd) ){
     /*  echo '<script type="text/javascript"> window.alert("Account is successfully updated");';
       echo 'window.location.href="profile.php";</script>';
     //  header("Location:profile.php");
       $_SESSION['username']=$username;*/
       echo true;
     }
     else{
       echo false;
     }
  }
}else{
  if(strlen($_REQUEST["materialID"])>0){

    $matID = $_REQUEST["materialID"];

    $sql_updateMat= "INSERT INTO registeredmaterial ( materialID, username) VALUES ( '$matID','$username')";

    if( $conn->query($sql_update) && $conn->query($sql_updateMat) ){
       echo true;
     }
     else{
       echo false;
     }

  }else{
    if( $conn->query($sql_update) ){
     /*  echo '<script type="text/javascript"> window.alert("Account is successfully updated");';
       echo 'window.location.href="profile.php";</script>';
     //  header("Location:profile.php");
       $_SESSION['username']=$username;*/
       echo true;
     }
     else{
       echo false;
     }
  }
}

//}


//Recycler

//if(isset($_GET["btnsubmit"])){
/*
  $username = $_SESSION["username"];
  $fullname = $_REQUEST["fullname"];
  $password= $_REQUEST["password"];

var_dump($_REQUEST);

  $sql_upRfn= "UPDATE users SET fullname='$fullname' WHERE username= '$username'";
  $sql_upRpwd = "UPDATE users SET password='$password' WHERE username= '$username'";

  $conn->query($sql_upRfn);
  $conn->query($sql_upRpwd );
}*/
?>
