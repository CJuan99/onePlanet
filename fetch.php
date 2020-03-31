<?php
//fetch.php
session_start();
include("conn.php");
$output = '';
$username = $_SESSION["username"];


if(isset($_POST["recycler"]) === true && empty($_POST["recycler"])===false)
{
 $search = mysqli_real_escape_string($conn, $_POST["recycler"]);
 $query = " SELECT * FROM submission, material WHERE submission.materialID = material.materialID AND status='Proposed' AND collector='$username' AND recycler LIKE '%".$search."%'
 ";
}

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
 <h5>Searching "'.$search.'" </h5>
  <div class="table-responsive ">
   <table class="table table-bordered table-hover table-light table-striped shadow w-100">
    <thead class="thead-dark">
    <tr>
     <th>Recycler Username</th>
      <th>Submission ID</th>
     <th>Material Name</th>
     <th>Proposed Date</th>
     <th>Status</th>
      <th>Action</th>

    </tr>
     </thead>
 ';
 while($row = mysqli_fetch_array($result))
 {
   $subID= array();
   $subID[]=$row["submissionID"];
   $_SESSION["submissionID"]=$subID;
  // print_r($subID);
   $_SESSION["recycler"]=$row["recycler"];
   $_SESSION["materialName"]=$row["materialName"];
   $_SESSION["proposedDate"]=$row["proposedDate"];


  $output .= '

   <tr>
    <td>'.$row["recycler"].'</td>
    <td>'.$row["submissionID"].'</td>
    <td class="d-none">'.$row["materialID"].'</td>
    <td>'.$row["materialName"].'</td>
    <td>'.$row["proposedDate"].'</td>
    <td>'.$row["status"].'</td>

    <td class="buttonGroup text-center">
      <button class="btn btn-success px-3 py-1 btnAccept" ><i class="far fa-check-circle"></i> Accept</button>
      <button class="btn btn-warning px-3 py-1 btnUpdate" ><i class="far fa-edit"></i>Update</button>
    </td>

   </tr>
  ';
 }
 echo $output;



}
else
{
 echo '<h5>Searching "'.$search.'" </h5>
<div class="bg-light py-3 px-3" ><h5> Submission not found</h5></div>

';
}




?>
