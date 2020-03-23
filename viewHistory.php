<?php

session_start();
include("conn.php");

$username = $_SESSION['username'];
$userType = $_SESSION['userType'];
$matID = $_POST["materialID"];
$matName = $_POST["materialName"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
  <link rel="stylesheet" type="text/css" href="css/ricky.css">
  <link rel="stylesheet" type="text/css" href="css/templatemo-style.css">
  <title>View History</title>
</head>

<body id="page-top" style="background-color: #D0F0C0;">

  <!-- Navigation -->
  <nav id="mainNav" class="navbar navbar-expand-lg navbar-light fixed-top pt-2">
    <div class="container">
      <button type="button" class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navBarUser" aria-controls="navBarUser" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon fa fa-user"></i>
      </button>
      <a class="navbar-brand js-scroll-trigger" href="index.php" id="logo">OnePlanet</a>
      <button type="button" class="navbar-toggler navbar-toggler-left" data-toggle="collapse" data-target="#navBarResponsive" aria-controls="navBarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon fas fa-bars fa-1x"></i>
      </button>

      <div class="collapse navbar-collapse" id="navBarResponsive">
        <ul class="navbar-nav ml-3  my-lg-0 ">
        <?php if(!empty($_SESSION['username'])) { ?>
			    <?php if($_SESSION['userType']=='Recycler') { ?>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger " href="#about">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#recycle">Recycle Now</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
                  </li>
          <?php }else { ?>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger " href="#about">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="recSub.php">My Collection</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
              </li>
            <?php } ?>
        <?php }else { ?>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger " href="#about">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#recycle">Recycle Now</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
              </li>
        <?php } ?>
      </div>
      <div class="collapse navbar-collapse" id="navBarUser">

        <ul class="nav navbar-nav ml-auto my-2 my-lg-0 ">

      	<?php if(!empty($_SESSION['username'])) { ?>
			<?php if($_SESSION['userType']=='Recycler') { ?>
				  <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="recprofile.php " > <span class="fa fa-user mx-3" aria-hidden="true"></span><?php echo $_SESSION['username']; ?></a>
				  </li>
			<?php } else{?>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="profile.php" > <span class="fa fa-user mx-3" aria-hidden="true"></span><?php echo $_SESSION['username']; ?></a>
				  </li>
			<?php } ?>
		   <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="logout.php"><span class="fas fa-sign-out-alt mx-3" aria-hidden="true"></span>Logout</a>
          </li>
		<?php } else { ?>
          <li class="nav-item ">
            <a class="nav-link js-scroll-trigger" href="index.php" data-toggle="modal" data-target="#login"> <span class="fa fa-lock mx-3" aria-hidden="true"></span>Sign In</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link js-scroll-trigger" href="index.php" data-toggle="modal" data-target="#signUp"> <span class="fa fa-user mx-3" aria-hidden="true"></span>Sign Up</a>
          </li>
    		<?php } ?>
        </ul>
      </div>
    </div>
  </nav>

<!--header-->
    <div class="jumbotron paral paralsec">
    <h1 class="display-3">Submission History</h1>
    <p class="lead"></p>
    </div>

    <div class="container bg-container my-5 px-4">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-4 text-center">
              <button id="showAll" class="btn btn-mint w-100 mt-4">Show All</button>
            </div>
            <div class="col-md-4 text-center">
              <button id="showProposed" class="btn btn-mint w-100 mt-4">Proposed</button>
            </div>
            <div class="col-md-4 text-center">
              <button id="showSubmitted" class="btn btn-mint w-100 my-4">Submitted</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="input-group md-form form-sm form-1 pl-0">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-mint py-1" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
                </div>
                <input id="searchDate" class="form-control my-0 py-1 bg-pale" type="text" placeholder="Search by actual date" aria-label="Search" autocomplete="off" onkeydown="return false;">
                <button id="clearDate" class="btn bg-transparent hidden" style="margin-left: -40px; z-index: 100;">
                  <i class="fa fa-times"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 my-4">
              <div id="submission_summary" class="bg-pale w-50 m-auto text-center py-3">
                <h4>Material: <?php echo $matName ?></h4>
                <?php
                if($userType=="Recycler"){
                  $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID'";
                }else{
                  $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID'";
                }
                $result_submissions = $conn->query($sql_submissions);

                $totalWeight=0;
                $totalPoints=0;
                if($result_submissions->num_rows>0){
                  while($row = $result_submissions->fetch_assoc()){
                    $totalWeight+=$row["weightInKg"];
                    $totalPoints+=$row["pointsAwarded"];
                  }
                }
                ?>
                <span class="totalAmount px-3">Total Weight: <?php echo $totalWeight ?></span><span id="separator_points_weight"> | </span><span class="totalAmount px-3">Total Points: <?php echo $totalPoints ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-md-offset-1">
              <div class="projects-holder mb-4">
                <div class="event-list">
                  <ul>
                    <?php
                    if($userType=="Recycler"){
                      $sql_submissions = "SELECT * FROM submission s, users u WHERE s.collector=u.username AND recycler='$username' AND materialID='$matID'";
                    }else{
                      $sql_submissions = "SELECT c.schedule, c.day, r.fullname AS recyclerName, submissionID, proposedDate, actualDate, weightInKg, pointsAwarded, status, recycler, collector FROM submission s, users c, users r WHERE s.collector=c.username AND s.recycler=r.username AND collector='$username' AND materialID='$matID'";
                    }
                    $result_submissions = $conn->query($sql_submissions);
                    if($result_submissions->num_rows>0){
                      $countColor=0;
                      while($row = $result_submissions->fetch_assoc()){
                        $countColor++;
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
                    }
                    ?>


                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="submission" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg rounded">
              <div class=" text-center py-3 ">
                <button type="button" class="close pr-2 text-success" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-success">Submission Details</h4>
              </div>
              <div class="modal-body">
                <div class="submission px-2 mx-auto mw-100 ">
                  <div class="signup-form">
                    <form action="javascript:void(0)" method="POST" name="submissionForm" id="submissionForm" novalidate>
                      <input type="text" class="form-control readOnlyColor d-none" name="submissionID" placeholder="SubmissionID" required readonly>
                      <?php if($userType=="Recycler"){ ?>
                      <div class="form-group">
                        <p class="text-muted p-0 mb-0 fs-12">Collector</p>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-people-carry fa-sm"></i></div>
                          </div>
                          <input type="text" class="form-control readOnlyColor" name="collector" placeholder="Collector" required readonly>
                        </div>
                      </div>
                    <?php }else{ ?>
                      <div class="form-group">
                        <p class="text-muted p-0 mb-0 fs-12">Recycler</p>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-street-view"></i></div>
                          </div>
                          <input type="text" class="form-control readOnlyColor" name="recycler" placeholder="Recycler" required readonly>
                        </div>
                      </div>
                    <?php } ?>
                      <div class="form-group">
                        <p class="text-muted p-0 mb-0 fs-12">Proposed Date</p>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                          </div>
                          <label id="scheduleDays" class="d-none"></label>
                          <input type="text" class="form-control readOnlyColor" name="proposedDate" placeholder="Proposed Date" required readonly autocomplete="off" onkeydown="return false;">
                        </div>
                      </div>
                      <div class="form-group">
                        <p class="text-muted p-0 mb-0 fs-12">Actual Date</p>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                          </div>
                          <input type="text" class="form-control readOnlyColor" name="actualDate" placeholder="--" required readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <p class="text-muted p-0 mb-0 fs-12">Weight(kg)</p>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-dumbbell"></i></div>
                          </div>
                          <input type="text" class="form-control readOnlyColor" name="weight" placeholder="Weight" required readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <p class="text-muted p-0 mb-0 fs-12">Points Awarded</p>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-coins"></i></div>
                          </div>
                          <input type="text" class="form-control readOnlyColor" name="pointsAwarded" placeholder="Points Awarded" required readonly>
                        </div>
                      </div>
                      <div class="text-center mb-3">
                        <input id="editBtn_form" class="w-40 mr-4 d-none" type="button" name="btn" value="edit">
                        <input id="saveBtn_form" class="w-40 mr-4 d-none" type="submit" name="btn" value="save">
                        <input id="deleteBtn_form" class="w-40 d-none" type="submit" name="btn" value="delete">
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- datepicker links -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">
      var all_selected=true;
      var proposed_selected=false;
      var submitted_selected=false;

      var old_data;

      $("#showAll").click(function(){
        $.post("retrieveSubmission.php", {username: "<?php echo $username ?>", action: "all", materialID: "<?php echo $matID ?>", materialName: "<?php echo $matName ?>", dateRange: $("#searchDate").val(), userType: "<?php echo $userType ?>"})
        .done(function(data){
          data_row_summary = data.split("~");
          data_row = data_row_summary[0];
          data_summary = data_row_summary[1];

          $(".event-list").html(data_row);
          $("#submission_summary").html(data_summary);
        });
        all_selected=true;
        proposed_selected=false;
        submitted_selected=false;
      });

      $("#showProposed").click(function(){
        $.post("retrieveSubmission.php", {username: "<?php echo $username ?>", action: "proposed", materialID: "<?php echo $matID ?>", materialName: "<?php echo $matName ?>", dateRange: $("#searchDate").val(), userType: "<?php echo $userType ?>"})
        .done(function(data){
          data_row_summary = data.split("~");
          data_row = data_row_summary[0];
          data_summary = data_row_summary[1];

          $(".event-list").html(data_row);
          $("#submission_summary").html(data_summary);
        });
        all_selected=false;
        proposed_selected=true;
        submitted_selected=false;
      });

      $("#showSubmitted").click(function(){
        $.post("retrieveSubmission.php", {username: "<?php echo $username ?>", action: "submitted", materialID: "<?php echo $matID ?>", materialName: "<?php echo $matName ?>", dateRange: $("#searchDate").val(), userType: "<?php echo $userType ?>"})
        .done(function(data){
          data_row_summary = data.split("~");
          data_row = data_row_summary[0];
          data_summary = data_row_summary[1];

          $(".event-list").html(data_row);
          $("#submission_summary").html(data_summary);
        });
        all_selected=false;
        proposed_selected=false;
        submitted_selected=true;
      });

      $('#searchDate').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        // changeYear: true,
        onSelect: function( selectedDate ) {

            if(!$(this).data().datepicker.first){
                $(this).data().datepicker.inline = true
                $(this).data().datepicker.first = selectedDate;
                $(this).data().datepicker.s_first = selectedDate;
                delete $(this).data().datepicker.s_second;
            }else{
                if(selectedDate > $(this).data().datepicker.first){
                    $(this).data().datepicker.s_second = selectedDate;
                    $(this).data().datepicker.s_first = $(this).data().datepicker.first;
                    $(this).val($(this).data().datepicker.first+" - "+selectedDate);
                }else{
                    $(this).val(selectedDate+" - "+$(this).data().datepicker.first);
                    $(this).data().datepicker.s_second = $(this).data().datepicker.first;
                    $(this).data().datepicker.s_first = selectedDate;
                }
                $(this).data().datepicker.inline = true;

                var $this = $(this);
                setTimeout(function(){
                    $this.datepicker("hide");
                    $this.data().datepicker.inline = false;
                },750)
            }
            $(this).datepicker("show"); // update the dates

        },
        onClose:function(){

            delete $(this).data().datepicker.first;
            $(this).data().datepicker.inline = false;
            $(this).blur()

        },  beforeShowDay: function (date) {

            var d = date.getTime();
            var d_str = date.toJSON().slice(0,10);

            s1 = $(this).data().datepicker.s_first;
            if (s1){
                var d1 = new Date(new String(s1).replace(new RegExp("-", 'g'), "/"));
                var d1_str = d1.toJSON().slice(0,10);
                var d1 = d1.getTime();
            }

            s2 = $(this).data().datepicker.s_second
            if (s2){
                var d2 = new Date(new String(s2).replace(new RegExp("-", 'g'), "/"));
                var d2_str = d2.toJSON().slice(0,10);
                var d2 = d2.getTime();
            }

            if (d_str == d1_str || d_str == d2_str) {
                return [true, 'ui-state-active', ''];
            }else if (d >  d1 && d < d2) {
                return [true, 'ui-state-active', ''];
            } else {
                return [true, ''];
            }
        }
      });

      $("#searchDate").focusout(function(){
        if(all_selected){
          $("#showAll").click();
        }else if(proposed_selected){
          $("#showProposed").click();
        }else{
          $("#showSubmitted").click();
        }
      });

      $('#searchDate').focusout(function() {
        var $this = $(this);
        var visible = Boolean($this.val());
        $this.siblings('#clearDate').toggleClass('hidden', !visible);
      }).trigger('focusout');

      $('#clearDate').click(function() {
        $('#searchDate').val('')
          .trigger('focusout');
      });

      $(".event-list").on("click", ".details", function(){
        var data = $(this).parent().parent().parent().parent().find("p.d-none");

        var form_inputs = $("#submissionForm").find("input");
        form_inputs[0].value = data[0].innerHTML;
        form_inputs[1].value = data[1].innerHTML;
        form_inputs[2].value = data[2].innerHTML;
        form_inputs[3].value = data[3].innerHTML;
        form_inputs[4].value = data[4].innerHTML;
        form_inputs[5].value = data[5].innerHTML;
        $("#scheduleDays").html(data[6].innerHTML);

        $(".schedule").datepicker("destroy");
        form_inputs[2].readOnly = true;
        form_inputs[2].classList.remove("schedule");
        form_inputs[2].classList.add("readOnlyColor");

        <?php if($userType=="Recycler"){?>
        if(data[7].innerHTML=="Submitted"){
          $("#editBtn_form").addClass("d-none");
          $("#saveBtn_form").addClass("d-none");
          $("#deleteBtn_form").addClass("d-none");
        }else{
          $("#editBtn_form").removeClass("d-none");
          $("#saveBtn_form").addClass("d-none");
          $("#deleteBtn_form").removeClass("d-none");
        }
        <?php } ?>
      });

      $("#submissionForm").submit(function(){
        var form_inputs = $("#submissionForm").find("input");
        var val = $(this).find("input[type=submit]:focus").val();
        if(val=="save"){
          if(old_data!=(form_inputs[2].value)){
            if(confirm("Are you sure to save?")){
              $.post("edit_delete.php", {submissionID:form_inputs[0].value, proposedDate:form_inputs[2].value, btn: val})
              .done(function(data){
                if(data){
                  alert("Submission updated successfully.");
                  location.reload();
                }else{
                  alert("Submission not updated successfully.");
                }
              });
            }
          }else{
            // reset modal to uneditable
            $("#editBtn_form").removeClass("d-none");
            $("#saveBtn_form").addClass("d-none");

            $(".schedule").datepicker("destroy");
            form_inputs[2].readOnly = true;
            form_inputs[2].classList.remove("schedule");
            form_inputs[2].classList.add("readOnlyColor");
          }
        }else{
          if(confirm("Are you sure to delete?")){
            $.post("edit_delete.php", {submissionID:form_inputs[0].value, proposedDate:form_inputs[2].value, btn: val})
            .done(function(data){
              if(data){
                alert("Submission deleted successfully.");
                location.reload();
              }else{
                alert("Submission not deleted successfully.");
              }
            });
          }
        }
      });

      $("#editBtn_form").click(function(){
        $(this).addClass("d-none");
        $("#saveBtn_form").removeClass("d-none");

        var form_inputs = $("#submissionForm").find("input");
        form_inputs[2].readOnly = false;
        form_inputs[2].classList.add("schedule");
        form_inputs[2].classList.remove("readOnlyColor");
        old_data = form_inputs[2].value;
      });

      $("#submissionForm").on("focus", ".schedule", function(){
        var noDays=[];
        $('.schedule').click(function(){
          $("#ui-datepicker-div").css('zIndex', '1060'); //set z-index of datepicker to fix the un-showing bug

          //find days that collector pick and convert (days "Text") to (days "Number")
          noDays=[];
          var dayPick = $(this).parent().find("label")[0].innerHTML;
          var days = dayPick.split(" ");
          for (var i = 0; i < days.length; i++) {
            switch($.trim(days[i])){
              case "Monday":
              noDays.push(1);
              break;
              case "Tuesday":
              noDays.push(2);
              break;
              case "Wednesday":
              noDays.push(3);
              break;
              case "Thursday":
              noDays.push(4);
              break;
              case "Friday":
              noDays.push(5);
              break;
              case "Saturday":
              noDays.push(6);
              break;
              case "Sunday":
              noDays.push(7);
              break;
            }
          }
        });

        $('.schedule').datepicker({
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
          // changeYear: true,
          minDate: 0,
          beforeShowDay: function (date) {
            $(this).click(); //to trigger the click event in progress of datepicker (Because .datepicker() will be triggered before .click()) -- But would cause to click many times
            var day = date.getDay();
            return [$.inArray(day, noDays)!=-1];
          }
        });

        $('.schedule').focus(function(){
          $("#ui-datepicker-div").css('zIndex', '1060'); //set z-index of datepicker to fix the un-showing bug
        });

      });

    </script>


  <!--footer-->
    <footer style="background-color: #2c292f">
      <div class="container ">
        <div class="row ">
          <div class="col-md-4 text-center text-md-left ">
            <div class="py-2 my-4">

              <h5 id='logo'>OnePlanet</h5>
              <ul class=" list-unstyled quick-links text-decoration-none py-2">
                <li class="nav-info"><a href="javascript:void();"><i class="fa fa-angle-double-right "></i>Home</a></li>
                <li class="nav-info"><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About Us</a></li>
                <li class="nav-info"><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Recycle Now</a></li>
                <li class="nav-info"><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Contact Us</a></li>
              </ul>

            </div>
          </div>

          <div class="col-md-4 text-white text-center text-md-left ">
            <div class="icon py-2 my-4">
              <div>
                <p class="text-white"> <i class="fa fa-map-marker-alt mx-2 "></i>
                  Menara Earth 1, Jalan Raja Laut
                  50350 Kuala Lumpur, MALAYSIA</p>
              </div>
              <div>
                <p><i class="fa fa-phone  mx-2 "></i> +03 2617 9000</p>
              </div>
              <div>
                <p><i class="fa fa-envelope  mx-2"></i><a class="text-decoration-none text-white" href="#">onePlanet.gmail.com</a></p>
              </div>
            </div>
          </div>

          <div class="col-md-4 text-white my-4 text-center text-md-left ">
            <div class="py-2 my-4">
              <blockquote class="blockquote text-center">
                <p class="font-italic">Plans to protect air and water, wilderness and wildlife are in fact plans to protect man.</p>
                <footer class="blockquote-footer text-white  ">
                  <cite title="Source Title">Stewart Udall</cite>
                </footer>
              </blockquote>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Copyright -->
    <div class="col-lg-12 footer-copyright text-center py-2 text-white bg-dark">© 2020 Copyright:
      <a class="text-white" href="#"> OnePlanet</a>
    </div>
    <!-- Copyright -->


    <!-- Footer -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>


    <script src="js/cj.js"></script>


  </body>


  </html>
