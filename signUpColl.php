<?php
$connect = mysqli_connect("localhost", "root", "", "onePlanet");
include("conn.php");
session_start();



//if(isset($_POST["regColl_btn"])){

$username = $_GET["username"];
$password = $_GET["password"];
$fullname = $_GET["fullname"];
$address = $_GET['address'];
$userType = "Collector";
$totalPoints= "0";

//$chk="";

$matID = $_GET['materials'];
$schedule = $_GET['time'];

 //var_dump($_POST);

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

  $for_day = '';
  if(!empty($_GET['day']))
  {
   foreach($_GET['day']as $day)
   {
    $for_day .= $day . ' ';
   }

   $queryInsertUser = "INSERT INTO users (username, password, fullname, totalPoints,address, userType, schedule,day) VALUES ('$username', '$password', '$fullname', '$totalPoints','$address','$userType','$schedule','$for_day')";
   $queryMaterials = "INSERT INTO registeredmaterial ( materialID, username) VALUES ( '$matID','$username')";

   if( $conn->query($queryInsertUser) &&  $conn->query($queryMaterials)){
     echo true;

 	}
 	else{
 		echo"fail query";
 	}
  }
  else
  {
		//Did check by JS, this lines are not necessary
		echo '<script type="text/javascript">window.alert("Please choose at least a day");';
	 echo 'window.location.href="index.php";</script>';
  }


}

//}
?>
