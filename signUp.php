<?php

include("conn.php");
session_start();



//if(isset($_POST["regRec_btn"])){

$username = $_GET["username"];
$password = $_GET["password"];
$fullname = $_GET["fullname"];
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
	echo false;
}else{

	$password=md5($password);

	$queryInsertUser = "INSERT INTO users (username, password, fullname, totalPoints, ecoLevel, userType) VALUES ('$username', '$password', '$fullname', '$totalPoints','$ecoLevel','$userType')";

	if( $conn->query($queryInsertUser) ){
    echo true;

	}
	else{
		echo"fail query";
	}
}

//}
?>
