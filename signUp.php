<?php

include("conn.php");
session_start();



if(isset($_POST["regRec_btn"])){

$username = $_POST["username"];
$password = $_POST["password"];
$fullname = $_POST["fullname"];
$userType = "Recycler";
$totalPoints= "0";
$ecoLevel= "Newbie";


$query = "SELECT * FROM users";
$results = $conn->query($query);

$userExist = false;
if($results->num_rows > 0){
	while($row = $results->fetch_assoc()){
		if(strtolower($username) == strtolower($row["username"])){
			$userExist = true;
		}
	}
}

if($userExist){
	echo '<script type="text/javascript">window.alert("Username has been taken. Please try again.");';
	echo 'window.location.href="index.php";</script>'; //instead header(); because unable to alert
}else{

	$password=md5($password);

	$queryInsertUser = "INSERT INTO users (username, password, fullname, totalPoints, ecoLevel, userType) VALUES ('$username', '$password', '$fullname', '$totalPoints','$ecoLevel','$userType')";

	if( $conn->query($queryInsertUser) ){
    echo '<script type="text/javascript">window.alert("Account is successfully created");';
  	echo 'window.location.href="index.php";</script>';

	}
	else{
		echo"fail query";
	}
}

}
?>
