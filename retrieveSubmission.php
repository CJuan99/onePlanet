<?php
include("conn.php");
session_start();

$username = $_POST["username"];
$matID = $_POST["materialID"];
$matName = $_POST["materialName"];
$action = $_POST["action"];
$dateRange = $_POST["dateRange"];
$dateFrom = "";
$dateTo = "";
$userType = $_POST["userType"];

// To split date range into date from and date to
if(strlen($dateRange)>0){
  if(strpos($dateRange, " - ")!=false){
    $dateFrom = explode(" - ", $dateRange)[0];
    $dateTo = explode(" - ", $dateRange)[1];
  }else{
    $dateFrom = $dateRange;
  }
}

if($userType=="Recycler"){
  if($action == "all"){
    if(strlen($dateFrom)>0){
      if(strlen($dateTo)>0){
        $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID' AND actualDate>='$dateFrom' AND actualDate<='$dateTo'";
      }else{
        $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID' AND actualDate='$dateFrom'";
      }
    }else{
      $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID'";
    }

  }elseif($action == "proposed"){
    if(strlen($dateFrom)>0){
      if(strlen($dateTo)>0){
        $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID' AND actualDate>='$dateFrom' AND actualDate<='$dateTo' AND status='Proposed'";
      }else{
        $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID' AND actualDate='$dateFrom' AND status='Proposed'";
      }
    }else{
      $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID' AND status='Proposed'";
    }

  }else{
    if(strlen($dateFrom)>0){
      if(strlen($dateTo)>0){
        $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID' AND actualDate>='$dateFrom' AND actualDate<='$dateTo' AND status='Submitted'";
      }else{
        $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID' AND actualDate='$dateFrom' AND status='Submitted'";
      }
    }else{
      $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID' AND status='Submitted'";
    }
  }
}else{
  if($action == "all"){
    if(strlen($dateFrom)>0){
      if(strlen($dateTo)>0){
        $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID' AND actualDate>='$dateFrom' AND actualDate<='$dateTo'";
      }else{
        $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID' AND actualDate='$dateFrom'";
      }
    }else{
      $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID'";
    }

  }elseif($action == "proposed"){
    if(strlen($dateFrom)>0){
      if(strlen($dateTo)>0){
        $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID' AND actualDate>='$dateFrom' AND actualDate<='$dateTo' AND status='Proposed'";
      }else{
        $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID' AND actualDate='$dateFrom' AND status='Proposed'";
      }
    }else{
      $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID' AND status='Proposed'";
    }

  }else{
    if(strlen($dateFrom)>0){
      if(strlen($dateTo)>0){
        $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID' AND actualDate>='$dateFrom' AND actualDate<='$dateTo' AND status='Submitted'";
      }else{
        $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID' AND actualDate='$dateFrom' AND status='Submitted'";
      }
    }else{
      $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID' AND status='Submitted'";
    }
  }
}


$result_submissions = $conn->query($sql_submissions);
if($result_submissions->num_rows>0){
  $countColor=0;
  $totalWeight=0;
  $totalPoints=0;
  echo '<ul>';
  while($row = $result_submissions->fetch_assoc()){
    $countColor++;
    $totalWeight+=$row["weightInKg"];
    $totalPoints+=$row["pointsAwarded"];
    if($countColor%2==1){
      echo '<li class="project-item first-child mix">
                <ul class="event-item">
                    <li>
                        <div class="date">
                            <span>'.(strlen($row["actualDate"])>0?date("j",  strtotime($row["actualDate"])).'<br>'.date("F",  strtotime($row["actualDate"])):"To Be<br>Confirmed").'</span>
                        </div>
                    </li>
                    <li>
                        <h4>'.($userType=="Recycler"?"TO: ".$row["fullname"]:"FROM: ".$row["recyclerName"]).'</h4>
                        <div class="'.($row["status"]=="Proposed"?"statusP":"statusS").'">
                            <span>'.$row["status"].'</span>
                        </div>
                    </li>
                    <li>
                        <div class="time">
                            <span>'.$row["schedule"].'<br>'.date("l", strtotime($row["proposedDate"])).'</span>
                        </div>
                    </li>
                    <li>
                        <div class="white-button">
                            <a class="details" href="javascript:void(0)" data-toggle="modal" data-target="#submission">Show Details</a>
                        </div>
                    </li>
                </ul>
                <p class="d-none">'.$row["submissionID"].'</p>
                <p class="d-none">'.($userType=="Recycler"?$row["fullname"]:$row["recyclerName"]).'</p>
                <p class="d-none">'.$row["proposedDate"].'</p>
                <p class="d-none">'.$row["actualDate"].'</p>
                <p class="d-none">'.$row["weightInKg"].'</p>
                <p class="d-none">'.$row["pointsAwarded"].'</p>
                <p class="d-none">'.$row["day"].'</p>
                <p class="d-none">'.$row["status"].'</p>
            </li>';
    }else{
      echo '<li class="project-item second-child mix">
                <ul class="event-item">
                    <li>
                        <div class="date">
                            <span>'.(strlen($row["actualDate"])>0?date("j",  strtotime($row["actualDate"])).'<br>'.date("F",  strtotime($row["actualDate"])):"To Be<br>Confirmed").'</span>
                        </div>
                    </li>
                    <li>
                        <h4>'.($userType=="Recycler"?"TO: ".$row["fullname"]:"FROM: ".$row["recyclerName"]).'</h4>
                        <div class="'.($row["status"]=="Proposed"?"statusP":"statusS").'">
                            <span>'.$row["status"].'</span>
                        </div>
                    </li>
                    <li>
                        <div class="time">
                            <span>'.$row["schedule"].'<br>'.date("l", strtotime($row["proposedDate"])).'</span>
                        </div>
                    </li>
                    <li>
                        <div class="white-button">
                            <a class="details" href="javascript:void(0)" data-toggle="modal" data-target="#submission">Show Details</a>
                        </div>
                    </li>
                </ul>
                <p class="d-none">'.$row["submissionID"].'</p>
                <p class="d-none">'.($userType=="Recycler"?$row["fullname"]:$row["recyclerName"]).'</p>
                <p class="d-none">'.$row["proposedDate"].'</p>
                <p class="d-none">'.$row["actualDate"].'</p>
                <p class="d-none">'.$row["weightInKg"].'</p>
                <p class="d-none">'.$row["pointsAwarded"].'</p>
                <p class="d-none">'.$row["day"].'</p>
                <p class="d-none">'.$row["status"].'</p>
            </li>';
    }
  }
  echo '</ul>';

  echo '~';

  echo '<h4>Material: '.$matName.'</h4>
        <span class="px-3">Total Weight: '.$totalWeight.'</span> | <span class="px-3">Total Points: '.$totalPoints.'</span>';
}else{
  echo '<ul>
          <li class="project-item first-child mix p-4">
            <span class="text-muted">No submission related to the filter.</span>
          </li>
        </ul>';

  echo '~';

  echo '<h4>Material: '.$matName.'</h4>
        <span class="px-3">Total Weight: 0</span> | <span class="px-3">Total Points: 0</span>';

}

?>
