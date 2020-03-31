<?php

session_start();
include("conn.php");

$username = $_SESSION['username'];
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
  <title>Propose Submission</title>
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
                    <a class="nav-link js-scroll-trigger " href="index.php#about">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php#recycle">Recycle Now</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact Us</a>
                  </li>
          <?php }else { ?>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger " href="index.php#about">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="recSub.php">My Collection</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact Us</a>
              </li>
            <?php } ?>
        <?php }else { ?>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger " href="index.php#about">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php#recycle">Recycle Now</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact Us</a>
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
    <h1 class="display-3">Submission</h1>
    <p class="lead"></p>
    </div>

    <div class="container">
      <div class="row">
        <table class="table bg-white mb-4">
          <h3 class="mt-5 mb-3">Collectors who collect the material, <?php echo $matName ?></h3>
          <thead>
            <tr class="bg-dark text-white">
              <th>Collector Name</th>
              <th>Address</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $recycler;
            $sql_recycler = "SELECT * FROM users WHERE username='$username'";
            $result_recycler = $conn->query($sql_recycler);
            if($result_recycler->num_rows>0){
              $recycler = $result_recycler->fetch_assoc();
            }
            $sql_collector = "SELECT * FROM users u, registeredmaterial r, material m WHERE u.username=r.username AND r.materialID=m.materialID AND m.materialID='$matID' AND u.username NOT IN (SELECT collector FROM submission WHERE recycler='$username' AND materialID='$matID' AND status='Proposed')";

            $result_collector = $conn->query($sql_collector);
            if($result_collector->num_rows>0){
              $i=0;
              while($row = $result_collector->fetch_assoc()){
                $i++;
                echo '<tr>
                        <td>'.$row["fullname"].'</td>
                        <td class="w-50">'.$row["address"].'</td>
                        <td class="text-center"><button class="btn btn-success px-3 py-1" data-toggle="modal" data-target="#submission'.$i.'">Propose</button></td>
                      </tr>';

                echo '<div class="modal fade" id="submission'.$i.'" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content shadow-lg rounded">
                            <div class=" text-center py-3 ">
                              <button type="button" class="close pr-2 text-success" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h4 class="modal-title text-success">Propose Submission</h4>

                            </div>
                            <div class="modal-body">
                              <div class="submission px-2 mx-auto mw-100 ">
                                <div class="signup-form">
                                  <form action="javascript:void(0);" method="POST" name="submissionForm" id="submissionForm'.$i.'">
                                    <div class="form-group">
                                      <p class="text-muted p-0 mb-0 fs-12">Collector</p>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-people-carry fa-sm"></i></div>
                                        </div>
                                        <input type="text" class="form-control readOnlyColor d-none" name="collectorID" placeholder="CollectorID" value="'.$row["username"].'" required readonly>
                                        <input type="text" class="form-control readOnlyColor" name="collector" placeholder="Collector" value="'.$row["fullname"].'" required readonly>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <p class="text-muted p-0 mb-0 fs-12">Recycler (You)</p>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-street-view"></i></div>
                                        </div>
                                        <input type="text" class="form-control readOnlyColor d-none" name="recyclerID" placeholder="RecyclerID" value="'.$recycler["username"].'" required readonly>
                                        <input type="text" class="form-control readOnlyColor" name="recycler" placeholder="Recycler" value="'.$recycler["fullname"].'" required readonly>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <p class="text-muted p-0 mb-0 fs-12">Material</p>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-box"></i></div>
                                        </div>
                                        <input type="text" class="form-control readOnlyColor d-none" name="materialID" placeholder="MaterialID" value="'.$row["materialID"].'" required readonly>
                                        <input type="text" class="form-control readOnlyColor" name="material" placeholder="Material" value="'.$row["materialName"].'" required readonly>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <p class="text-muted p-0 mb-0 fs-12">Schedule Date</p>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                        </div>
                                        <label class="d-none">'.$row["day"].'</label>
                                        <input type="text" class="form-control schedule" name="schedule" placeholder="Please select a date" required autocomplete="off" onkeydown="return false;">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <p class="text-muted p-0 mb-0 fs-12">Schedule Time</p>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                        <input type="text" class="form-control readOnlyColor" name="time" placeholder="Time" value="'.$row["schedule"].'" required readonly>
                                      </div>
                                    </div>
                                    <div class="text-center mb-3">
                                      <input type="submit" name="btn" value="Confirm">
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>';
              }
            }else{
              echo '<tr>
                      <td colspan="3" class="text-muted">No available collector that not proposed yet to collect this material. Please try propose another material.</td>
                    </tr>';
            }
            ?>
          </tbody>
        </table>

        <button onclick='window.location.href="index.php#recycle"' class="btn btn-primary mb-5">Back To Select Material</button>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- datepicker links -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">

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


    jQuery(document).ready(function(){
        $('form[name="submissionForm"]').submit(function(){ //not direcly use $(this).find("input") is bcuz it can't access the child but can access parent. (This problem can be caused by dynamic created element (with php/java/so on) )

          var submissionID = $(this).parent().parent().parent().parent().parent().parent().attr("id");
          var fields = $("#"+submissionID).find("input");

          //fields.get(i).value OR fields[i].value (as it is not jQuery, it is HTML object)

          $.post("submit.php", {proposedDate: fields[6].value, recyclerID: fields[2].value, collectorID: fields[0].value, materialID: fields[4].value})
          .done(function(data){
            if(data){
              alert("Submission proposed successfully.");
              location.reload();
            }else{
              alert("Submission not proposed successfully.");
            }
          });

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
