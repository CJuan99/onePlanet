<?php
session_start();
include("conn.php");
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

$sql_insert = "INSERT INTO submission (submissionID,proposedDate,actualDate,weightInKg,status,recycler,collector,materialID) VALUES ('$submissionID', null, now(), '$weightNew','Submitted', '$recNew', '$username', '$matID')";

if($conn->query($sql_insert)){
  echo "A new submission is inserted";
}else{
  echo "Unable to insert";
}
}?>
