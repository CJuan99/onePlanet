<?php
include("conn.php");

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

$proposedDate = $_POST["proposedDate"];
$recyclerID = $_POST["recyclerID"];
$collectorID = $_POST["collectorID"];
$materialID = $_POST["materialID"];

$sql_insert = "INSERT INTO submission VALUES ('$submissionID', '$proposedDate', null, 0, 0, 'Proposed', '$recyclerID', '$collectorID', '$materialID')";

if($conn->query($sql_insert)){
  echo true;
}else{
  echo false;
}

?>
