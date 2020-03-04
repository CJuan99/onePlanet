<?php
  include("conn.php");

if(isset($_POST["btnsubmit"])){

  $materialID = $_REQUEST["mid"];
  $materialName = $_REQUEST["mn"];
  $description = $_REQUEST["desc"];
  $points = $_REQUEST["p"];

  $sql_update = "UPDATE material SET materialName='$materialName', description='$description', pointsPerKg='$points' WHERE materialID = '$materialID'";

  $conn->query($sql_update);
?>
