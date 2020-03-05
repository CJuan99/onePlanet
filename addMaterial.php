<?php
include("conn.php");
session_start();

$sql_materials = "SELECT * FROM material";
$result_materials = $conn->query($sql_materials);

if(isset($_POST["addBtn"])){
  $materialID = $result_materials->num_rows + 1;
  $materialName = $_POST["materialName"];
  $description = $_POST["description"];
  $points = $_POST["points"];

  $materialDuplicated = false;

  if($result_materials->num_rows>0){
    while($row = $result_materials->fetch_assoc()){
      if($row["materialName"] == $materialName){
        $materialDuplicated = true;
      }
    }
  }

  if($materialDuplicated){
    echo '<script type="text/javascript">window.alert("Material duplicated. Please enter another material name.");';
		echo 'window.location.href="maintainMaterial.php";</script>'; //instead header(); because unable to alert
  }else{
    $sql_insert = "INSERT INTO material VALUES ('$materialID', '$materialName', '$description', '$points')";

    if($conn->query($sql_insert)){
      header("Location:maintainMaterial.php");
    }else{
      echo 'fail query';
    }
  }
}



?>
