<?php
session_start();
include("conn.php");

$points=0;
$pA=0;

if(isset($_POST["weightInKg"]) && isset($_POST["materialID"]))
{

$username = $_SESSION["username"];
$rec = $_POST["recycler"];
$sub=$_POST["submissionID"];
$matID= $_POST["materialID"];
$weight= $_POST["weightInKg"];

$sqlPoints= "SELECT pointsPerKg from material where materialID='$matID'";
$rpoint= $conn->query($sqlPoints);
if($rpoint->num_rows>0){
    while($row = $rpoint->fetch_assoc()){
      $points=$row["pointsPerKg"];
}
}
$pA= $weight*$points;

$sqlAcc= "UPDATE submission SET weightInKg='$weight', actualDate= now(),pointsAwarded='$pA', status='Submitted', materialID='$matID' WHERE submissionID='$sub'";
//mysqli_query($conn,"UPDATE submission SET weightInKg='$weight', actualDate= now(),pointsAwarded='$pA', status='Submitted' WHERE submissionID='$sub'") or die(mysqli_error($conn));
//$sqlUpdate = "UPDATE submission SET weightInKg='$weight' AND status='Submitted' WHERE submissionID='$sub'";
mysqli_query($conn,"UPDATE users set totalPoints= totalPoints+'$pA' where username='$username' OR username='$rec'") or die(mysqli_error($conn));

if($conn->query($sqlAcc)){
  echo "Submission is updated and confirmed ";
}else{
  echo "Unable to update";
}
}?>
