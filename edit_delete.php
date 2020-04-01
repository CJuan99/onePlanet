<?php
include("conn.php");

$submissionID = $_POST["submissionID"];
$proposedDate = $_POST["proposedDate"];

if($_POST["btn"]=="save"){
  $sql_update_delete = "UPDATE submission SET proposedDate='$proposedDate' WHERE submissionID='$submissionID'";
}else{
  $sql_update_delete = "DELETE FROM submission WHERE submissionID='$submissionID'";
}

if($conn->query($sql_update_delete)){
  echo true;
}else{
  echo false;
}


?>
