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
    <td>'.$row["materialName"].'</td>
    <td>'.$row["proposedDate"].'</td>
    <td>'.$row["status"].'</td>

    <td class="buttonGroup text-center">
      <button class="btn btn-success px-3 py-1 btnAccept" ><i class="far fa-check-circle"></i> Accept</button>
      <button class="btn btn-warning px-3 py-1" data-toggle="modal" data-target="#updateSub" id="btnUpdate" ><i class="far fa-edit"></i>Update</button>
    </td>

   </tr>
  ';
 }
 echo $output;



}
else
{
 echo '<h5>Searching "'.$search.'" </h5>
<div class="bg-light py-3 px-3" ><h5> Data Not Found</h5></div>

';
}

if(isset($_POST['weightAcc'])){
  $rec =$_POST['txt_recUn'];
  $sub=$_POST['txt_sub'];
  $mat=$_POST['txt_mat'];
  $weight=$_POST['weightAcc'];

  $sqlAccpt="UPDATE submission SET weightInKg='$weight', actualDate= now() where submissionID= '$sub'";
  if( $conn->query($sqlAccpt) ){
      echo '<script> alert("Data Updated"); </script>';
   }
   else{
      echo '<script> alert("Data Not Updated"); </script>';
   }
  /*update submission
set pointAwarded = (select submission.weightInKg*material.pointPerKG from submission,material where material.materialID = submission.materialID AND submission.submissionID='S008')*/
}


?>
