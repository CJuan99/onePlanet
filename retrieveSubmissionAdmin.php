<?php
include("conn.php");

$matID = $_POST["materialID"];

$sql_submission = "SELECT * FROM submission WHERE materialID='$matID'";
$results = $conn->query($sql_submission);
if($results->num_rows > 0){
  $array_data = array();
  $totalWeight=0;
  $totalPoints=0;
  while($row = $results->fetch_assoc()){
    $totalWeight+=$row["weightInKg"];
    $totalPoints+=$row["pointsAwarded"];
    array_push($array_data, $row);
  }

  $three_array = array($array_data, $totalWeight, $totalPoints);

  echo json_encode($three_array);
}
?>
