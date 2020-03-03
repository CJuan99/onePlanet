<?php
  include("conn.php");

  $materialID = $_REQUEST["mid"];
  $materialName = $_REQUEST["mn"];
  $description = $_REQUEST["desc"];
  $points = $_REQUEST["p"];

  $sql_update = "UPDATE material SET materialName='$materialName', description='$description', points='$points'
                WHERE materialID = '$materialID'";

  $conn->query($sql_update);

?>
