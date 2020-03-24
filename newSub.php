<?php
session_start();
include("conn.php");

$points=0;
$pA=0;
$tp=0;
$ecoLevel="";
if(isset($_POST["recycler"]) && isset($_POST["materialID"])&& isset($_POST["weightInKg"]) )
{
$sql_submission = "SELECT * FROM submission";
$result_submission = $conn->query($sql_submission);
if($result_submission->num_rows>0){
  $i=0;
  while($row = $result_submission->fetch_assoc()){ //loop to check and use not used submissionID in database (prevent duplicated/skipped primarykey no)
    $i++;
    if($row["submissionID"]!=$i){
      $submissionID = $i;
      break;
    }
    $submissionID = $i+1; //in case all same submissionID, and finished loop. To assign a submissionID for new data
  }
}else{
  $submissionID = $result_submission->num_rows + 1;
}

$username = $_SESSION["username"];
$recNew = $_POST["recycler"];
$matID= $_POST["materialID"];
$weightNew= $_POST["weightInKg"];


$sqlPoints= "SELECT pointsPerKg from material where materialID='$matID'";
$rpoint= $conn->query($sqlPoints);
if($rpoint->num_rows>0){
    while($row = $rpoint->fetch_assoc()){
      $points=$row["pointsPerKg"];
}
}


$pA= $weightNew*$points;

$sqlInsert="INSERT INTO submission  VALUES ('$submissionID', null, now(), '$weightNew','$pA','Submitted', '$recNew', '$username', '$matID')";

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
  $ecoLevel='Eco Newbie';
}
mysqli_query($conn,"UPDATE users set totalPoints='$tp' where username='$username'") or die(mysqli_error($conn));
mysqli_query($conn,"UPDATE users set totalPoints='$tp', ecoLevel='$ecoLevel' where username='$rec'") or die(mysqli_error($conn));

//mysqli_query($conn,"UPDATE users set totalPoints= totalPoints+'$pA' where username='$username' OR username='$recNew'") or die(mysqli_error($conn));


if($conn->query($sqlInsert)){
    echo "A new submission is inserted";
}else{
  echo "Unable to insert";
}



/*

$points=mysqli_query($conn,"SELECT pointsPerKg from material where materialID='$matID'") or die(mysqli_error($conn));

(SELECT
SUM(weightInKg*pointsPerKG)
FROM submission,material
WHERE submission.materialID=material.materialID AND submissionID='$submissionID'),'Submitted', '$recNew', '$username', '$matID')

$pointAwarded= mysqli_query($conn,"SELECT SUM (weightInKg*pointsPerKg) FROM submission, material") or die(mysqli_error($conn));
//$sql_insert = "INSERT INTO submission (submissionID,proposedDate,actualDate,weightInKg,status,recycler,collector,materialID) VALUES ('$submissionID', null, now(), '$weightNew','Submitted', '$recNew', '$username', '$matID')";

/*$sqlPA="INSERT INTO submission(pointAwarded)
SELECT
SUM(submission.weightInKg*material.pointsPerKG)
FROM submission,material
WHERE submission.materialID=material.materialID AND submissionID='$submissionID'";

/*$sqlPA="UPDATE submission set pointAwarded =(select submission.weightInKg*material.pointPerKG
  from submission,material where material.materialID = submission.materialID AND submissionID='$submissionID')";

$sqlPA="UPDATE submission set pointAwarded= material.pointPerKg*submission.weightInKg from submission inner join material on submission.submissionID= material.materialID and submission.submissionID='$submissionID'";*/
 /*mysqli_query($conn,"INSERT INTO submission VALUES ('$submissionID', null, now(), '$weightNew', (SELECT
 SUM(weightInKg*pointsPerKG)
 FROM submission,material
 WHERE submission.materialID=material.materialID AND submissionID='$submissionID'),'Submitted', '$recNew', '$username', '$matID')") or die(mysqli_error($conn));*/

/*if($conn->query($sql_insert)){

    echo "A new submission is inserted";
}else{
  echo "Unable to insert";
}*/
}?>
