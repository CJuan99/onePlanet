<?php
//fetch.php
session_start();
include("conn.php");
$output = '';



if(isset($_POST["recycler"]) === true && empty($_POST["recycler"])===false)
{
 $search = mysqli_real_escape_string($conn, $_POST["recycler"]);
 $query = "  SELECT * FROM submission, material WHERE submission.materialID = material.materialID AND recycler LIKE '%".$search."%'
 ";
}

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
 <h5>Searching "'.$search.'" </h5>
  <div class="table-responsive">
   <table class="table table bordered table-hover table-light">
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
  $output .= '

   <tr>
    <td>'.$row["recycler"].'</td>
    <td>'.$row["submissionID"].'</td>
    <td>'.$row["materialName"].'</td>
    <td>'.$row["proposedDate"].'</td>
    <td>'.$row["status"].'</td>

    <td class="buttonGroup text-center">
      <button class="btn btn-success px-3 py-1" data-toggle="modal" data-target="#acceptSub"><i class="far fa-check-circle"></i> Accept</button>
      <button class="btn btn-warning px-3 py-1" data-toggle="modal" data-target="#updateSub"><i class="far fa-edit"></i>Update</button>
    </td>

   </tr>
  ';
 }
 echo $output;
 $_SESSION["submissionID"]=$row["submissionID"];
 $_SESSION["recycler"]=$row["recycler"];
 $_SESSION["materialName"]=$row["materialName"];

}
else
{
 echo '<h5>Searching "'.$search.'" </h5>
<div class="bg-light py-3 px-3" ><h5> Data Not Found</h5></div>

';
}

?>