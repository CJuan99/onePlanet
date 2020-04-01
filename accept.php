<?php
session_start();
include("conn.php");

$points=0;
$pA=0;
$tp=0;
$ecoLevel="";

if(isset($_POST["weightInKg"]) )
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

$sqlEco ="SELECT totalPoints, ecoLevel from users where username='$rec'";
$reco= $conn->query($sqlEco);
if($reco->num_rows>0){
    while($row = $reco->fetch_assoc()){
      $tp=$row["totalPoints"];
}

}

$tp=$tp+$pA;

if($tp > 1000){
  $ecoLevel='Eco Warrior';
}else if($tp > 500){
    $ecoLevel='Eco Hero';
}else if($tp > 100){
   $ecoLevel = 'Eco Saver';
}else{
  $ecoLevel='Newbie';
}

$sqlAcc= "UPDATE submission SET weightInKg='$weight', actualDate= now(),pointsAwarded='$pA', status='Submitted' WHERE submissionID='$sub'";
//mysqli_query($conn,"UPDATE submission SET weightInKg='$weight', actualDate= now(),pointsAwarded='$pA', status='Submitted' WHERE submissionID='$sub'") or die(mysqli_error($conn));
//$sqlUpdate = "UPDATE submission SET weightInKg='$weight' AND status='Submitted' WHERE submissionID='$sub'";
mysqli_query($conn,"UPDATE users set totalPoints=totalPoints+'$pA' where username='$username'") or die(mysqli_error($conn));
mysqli_query($conn,"UPDATE users set totalPoints='$tp', ecoLevel='$ecoLevel' where username='$rec'") or die(mysqli_error($conn));

if($conn->query($sqlAcc)){
  echo "Submission is confirmed ";
}else{
  echo "Unable to accept the submission";
}
}?>
