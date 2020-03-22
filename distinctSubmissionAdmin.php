<?php
include("conn.php");

$matID = $_POST["materialID"];

$sql_submissionID = "SELECT DISTINCT submissionID FROM submission WHERE materialID='$matID'";
$sql_proposedDate = "SELECT DISTINCT proposedDate FROM submission WHERE materialID='$matID'";
$sql_actualDate = "SELECT DISTINCT actualDate FROM submission WHERE materialID='$matID'";
$sql_collector = "SELECT DISTINCT collector FROM submission WHERE materialID='$matID'";
$sql_recycler = "SELECT DISTINCT recycler FROM submission WHERE materialID='$matID'";
$sql_status = "SELECT DISTINCT status FROM submission WHERE materialID='$matID'";
$sql_weightInKg = "SELECT DISTINCT weightInKg FROM submission WHERE materialID='$matID'";
$sql_pointsAwarded = "SELECT DISTINCT pointsAwarded FROM submission WHERE materialID='$matID'";

$results_submissionID = $conn->query($sql_submissionID);
$results_proposedDate = $conn->query($sql_proposedDate);
$results_actualDate = $conn->query($sql_actualDate);
$results_collector = $conn->query($sql_collector);
$results_recycler = $conn->query($sql_recycler);
$results_status = $conn->query($sql_status);
$results_weightInKg = $conn->query($sql_weightInKg);
$results_pointsAwarded = $conn->query($sql_pointsAwarded);

$array_distinct_submission = array();

if($results_submissionID->num_rows > 0){
  $array_submissionID = array();
  while($row = $results_submissionID->fetch_assoc()){
    array_push($array_submissionID, $row["submissionID"]);
  }
  array_push($array_distinct_submission, $array_submissionID);
}
if($results_proposedDate->num_rows > 0){
  $array_proposedDate = array();
  while($row = $results_proposedDate->fetch_assoc()){
    array_push($array_proposedDate, $row["proposedDate"]);
  }
  array_push($array_distinct_submission, $array_proposedDate);
}
if($results_actualDate->num_rows > 0){
  $array_actualDate = array();
  while($row = $results_actualDate->fetch_assoc()){
    array_push($array_actualDate, $row["actualDate"]);
  }
  array_push($array_distinct_submission, $array_actualDate);
}
if($results_collector->num_rows > 0){
  $array_collector = array();
  while($row = $results_collector->fetch_assoc()){
    array_push($array_collector, $row["collector"]);
  }
  array_push($array_distinct_submission, $array_collector);
}
if($results_recycler->num_rows > 0){
  $array_recycler = array();
  while($row = $results_recycler->fetch_assoc()){
    array_push($array_recycler, $row["recycler"]);
  }
  array_push($array_distinct_submission, $array_recycler);
}
if($results_status->num_rows > 0){
  $array_status = array();
  while($row = $results_status->fetch_assoc()){
    array_push($array_status, $row["status"]);
  }
  array_push($array_distinct_submission, $array_status);
}
if($results_weightInKg->num_rows > 0){
  $array_weightInKg = array();
  while($row = $results_weightInKg->fetch_assoc()){
    array_push($array_weightInKg, $row["weightInKg"]);
  }
  array_push($array_distinct_submission, $array_weightInKg);
}
if($results_pointsAwarded->num_rows > 0){
  $array_pointsAwarded = array();
  while($row = $results_pointsAwarded->fetch_assoc()){
    array_push($array_pointsAwarded, $row["pointsAwarded"]);
  }
  array_push($array_distinct_submission, $array_pointsAwarded);
}

echo json_encode($array_distinct_submission);


?>
