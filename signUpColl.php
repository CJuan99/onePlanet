<?php

include("conn.php");
session_start();

//$sqlUsers = "SELECT * FROM users";
//$userTable = $conn->query($sqlUsers);


if(isset($_POST["regColl_btn"])){
// attributes for user table
/*$userID = $userTable->num_rows + 1;*/
$username = $_POST["username"];
$password = $_POST["password"];
$fullname = $_POST["fullname"];
$address = $_POST['address'];
$userType = "Collector";
$totalPoints= "0";


$matID = $_POST['materials'];
$schedule = $_POST['time'];

 var_dump($_POST);

$query = "SELECT * FROM users";
$results = $conn->query($query);

$userExist = false;
if($results->num_rows > 0){
	while($row = $results->fetch_assoc()){
		if($username == $row["username"]){
			$userExist = true;
		}
	}
}

if($userExist){
	echo '<script type="text/javascript">window.alert("User already exist. Please try again.");';
	echo 'window.location.href="index.php";</script>'; //instead header(); because unable to alert
}else{

	//$password=md5($password);
	// insert into user table
	$queryInsertUser = "INSERT INTO users (username, password, fullname, totalPoints,address, userType, schedule) VALUES ('$username', '$password', '$fullname', '$totalPoints','$address','$userType','$schedule')";
	// insert into applicant table
	$queryMaterials = "INSERT INTO registeredmaterial ( materialID, username) VALUES ( '$matID','$username')";


	if( $conn->query($queryInsertUser) &&  $conn->query($queryMaterials)){
    echo '<script type="text/javascript">window.alert("Account is successfully created");';
		header("Location:index.php");
		//$_SESSION['fullname']=$fullname;
		//$_SESSION['userType']='applicant';
	}
	else{
		echo"fail query";
	}

/*
		if( $conn->query($queryMaterials) ){
			header("Location:index.php");
		 ec
			//$_SESSION['fullname']=$fullname;
			//$_SESSION['userType']='applicant';
		}
		else{
			echo"fail query";
		}
*/
}

}
?>
