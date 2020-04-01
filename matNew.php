<?php

session_start();
include("conn.php");
$username = $_SESSION["username"];

$output = '';

if(isset($_POST["recycler"]) )
{
$rec = $_POST["recycler"];

$query ="SELECT * FROM material
WHERE materialStatus='Available'
AND materialID Not IN (SELECT materialID
FROM submission WHERE collector='$username' AND recycler='$rec' AND status='Proposed')";

//SELECT * FROM material WHERE materialStatus='Available' AND materialID NOT IN (SELECT materialID FROM submission WHERE collector='--collector id--' AND recycler='--recycler id--' AND status='Proposed')

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0)
{

  while($mat = mysqli_fetch_array($result))
  {
      echo "<option value='". $mat['materialID']."'>" . $mat['materialID']. ", ".$mat['materialName']."</option>";

    }
}else{
  echo "<option value=''>No available material</option>";
}

}else{
  echo "NOT FOUND";
}
 ?>
