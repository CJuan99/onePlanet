<?php
include("conn.php");
session_start();

$sql_materials = "SELECT * FROM material";
$result_materials = $conn->query($sql_materials);

$sql_availableMaterials = "SELECT * FROM material WHERE materialStatus = 'Available'";
$result_availableMaterials = $conn->query($sql_availableMaterials);

if(isset($_POST["addBtn"])){
  $materialID = $result_materials->num_rows + 1;
  $materialName = $_POST["materialName"];
  $description = $_POST["description"];
  $points = $_POST["points"];

  $materialDuplicated = false;

  if($result_availableMaterials->num_rows>0){
    while($row = $result_availableMaterials->fetch_assoc()){
      if($row["materialName"] == $materialName){
        $materialDuplicated = true;
      }
    }
  }

  if($materialDuplicated){
    echo '<script type="text/javascript">window.alert("Material duplicated. Please enter another material name.");';
		echo 'window.location.href="maintainMaterial.php";</script>'; //instead header(); because unable to alert
  }else{
    $materialExist = false;

    if($result_materials->num_rows>0){
      while($row = $result_materials->fetch_assoc()){
        if($row["materialName"] == $materialName){
          $materialExist = true;
        }
      }
    }

    if($materialExist){
      $sql_addMat = "UPDATE material SET materialStatus='Available', description='$description', pointsPerKg='$points' WHERE materialName='$materialName'";
    }else{
      $sql_addMat = "INSERT INTO material VALUES ('$materialID', '$materialName', '$description', '$points', 'Available')";
    }

    if($conn->query($sql_addMat)){
      header("Location:maintainMaterial.php");
    }else{
      echo 'fail query';
    }
  }
}



?>
