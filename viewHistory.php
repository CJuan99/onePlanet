<?php

session_start();
include("conn.php");

$username = $_SESSION['username'];
$matID = '8'; //$_POST["materialID"];
$matName = 'Batteries'; //$_POST["materialName"];

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
  <title>Collector Profile</title>
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
              <button class="btn btn-mint w-100 my-4">Show All</button>
            </div>
            <div class="col-md-4 text-center">
              <button class="btn btn-mint w-100 my-4">Proposed</button>
            </div>
            <div class="col-md-4 text-center">
              <button class="btn btn-mint w-100 my-4">Submitted</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="input-group md-form form-sm form-1 pl-0">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-mint py-1" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
                </div>
                <input class="form-control my-0 py-1 bg-pale" type="text" placeholder="Search by date" aria-label="Search">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 my-4">
              <div class="bg-pale w-50 m-auto text-center py-3">
                <h4>Material: Textiles</h4>
                <span class="px-3">Total Points: 1234</span> | <span class="px-3">Total Weight: 237</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <div class="projects-holder mb-4">
                    <div class="event-list">
                        <ul>
                            <li class="project-item first-child mix">
                                <ul class="event-item">
                                    <li>
                                        <div class="date">
                                            <span>12<br>May</span>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>four loko franzen</h4>
                                        <div class="statusP">
                                            <span>statusP Conferences</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="time">
                                            <span>8:00 AM - 11:00 AM<br>Saturday</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="white-button">
                                            <a href="#">I am interested</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="project-item second-child mix">
                                <ul class="event-item">
                                    <li>
                                        <div class="date">
                                            <span>24<br>April</span>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>Drink vinegar coloring</h4>
                                        <div class="statusS">
                                            <span>Design Meeting</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="time">
                                            <span>03:00 PM - 07:00 PM<br>Tuesday</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="white-button">
                                            <a href="#">I am interested</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="project-item first-child mix">
                                <ul class="event-item">
                                    <li>
                                        <div class="date">
                                            <span>12<br>May</span>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>four loko franzen</h4>
                                        <div class="statusP">
                                            <span>statusP Conferences</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="time">
                                            <span>8:00 AM - 11:00 AM<br>Saturday</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="white-button">
                                            <a href="#">I am interested</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="project-item second-child mix">
                                <ul class="event-item">
                                    <li>
                                        <div class="date">
                                            <span>24<br>April</span>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>Drink vinegar coloring</h4>
                                        <div class="statusP">
                                            <span>Design Meeting</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="time">
                                            <span>03:00 PM - 07:00 PM<br>Tuesday</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="white-button">
                                            <a href="#">I am interested</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="project-item first-child mix">
                                <ul class="event-item">
                                    <li>
                                        <div class="date">
                                            <span>12<br>May</span>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>four loko franzen</h4>
                                        <div class="statusS">
                                            <span>statusP Conferences</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="time">
                                            <span>8:00 AM - 11:00 AM<br>Saturday</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="white-button">
                                            <a href="#">I am interested</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="project-item second-child mix">
                                <ul class="event-item">
                                    <li>
                                        <div class="date">
                                            <span>24<br>April</span>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>Drink vinegar coloring</h4>
                                        <div class="statusS">
                                            <span>Design Meeting</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="time">
                                            <span>03:00 PM - 07:00 PM<br>Tuesday</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="white-button">
                                            <a href="#">I am interested</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
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
