<?php

session_start();
include("conn.php");



/*numColl= SELECT materialID,count(*) as numberOfCollector FROM registeredmaterial;
$collector = mysqli_query($conn, $numColl);*/
/*
$qry = "SELECT * FROM material";
$result = mysqli_query($conn, $qry);
$matRecd = mysqli_fetch_assoc($result);

if(isset($_POST['materialID'])){
	$matID= $_POST['materialID'];
	$_SESSION['materialID']=$matID;
}*/

$sql = "SELECT * FROM material";
$result = $conn->query($sql);
$arr_mat= [];

if ($result->num_rows > 0) {
    $arr_mat = $result->fetch_all(MYSQLI_ASSOC);
}

if(isset($_POST['materialID'])){
	$matID= $_POST['materialID'];
	$_SESSION['materialID']= $matID;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
  <title>OnePlanet</title>
  <link rel="icon" href="images/favicon.ico" type="image/ico">
</head>

<body id="page-top">

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
                <a class="nav-link js-scroll-trigger" href="#recycle">My Collection</a>
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
			<?php } elseif($_SESSION['userType']=='Admin')?>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="maintainMaterial.php" > <span class="fa fa-user mx-3" aria-hidden="true"></span><?php echo $_SESSION['username']; ?></a>
				  </li>
			<?php } else {?>
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

  <!--sign in-->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg rounded">
        <div class=" text-center py-3 ">
          <button type="button" class="close pr-2 text-success" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-success">SIGN IN</h4>

        </div>
        <div class="modal-body">
          <div class="login px-2 mx-auto mw-100 ">
            <div class="signup-form profile">
              <form action="login.php" method="POST" id="loginForm" name="loginForm">
                <div class="form-group">
                  <!--  <label class="mb-2">Username</label>-->
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-user-tie text-default"></i></div>
                    </div>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required minlength="4" pattern="[A-Za-z0-9]+" title="Username must be alphanumeric">
                  </div>
                </div>
                <div class="form-group">
                  <!--<label class="mb-2">Password</label>-->
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key icon text-default"></i></span>
                    </div>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required minlength="6">
                  </div>

                </div>
                <div class="text-center">
                  <input type="submit" name="signin_btn" value="sign in">
                </div>
                <p class="text-center pb-4">
                  <span>Don't have an account?</span>

                  <a class="text-decoration-none text-success" href="#" data-toggle="modal" data-target="#signUp" data-dismiss="modal">Click here to register</a>
                </p>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!--signup-->
  <div class="modal fade" id="signUp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg rounded ">
        <div class=" text-center py-3 ">
          <button type="button" class="close pr-2 text-success" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-success">SIGN UP</h4>

        </div>
        <div class="project-tab">
          <div class="col-md-12">
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="nav-home" aria-selected="true">Recycler</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#menu1" role="tab" aria-controls="nav-profile" aria-selected="false">Collector</a </div>
            </nav>
          </div>
        </div>
        <div class="modal-body">
          <div class="login px-2 mx-auto mw-100">
            <div class="tab-content">
              <div id="home" class="tab-pane active in">
                <div class="signup-form profile">
                  <form action="signUp.php" method="POST" enctype="multipart/form-data" name="registration" id="registration" >
                    <div class="form-group ">
                      <!--<label for="name">Username</label>-->
                      <input type="text" class="form-control" id="runame" placeholder="Username" name="username" required minlength="4" pattern="[A-Za-z0-9]+" title="Username must be alphanumeric with at least ">
                    <!--  <span id="span"> </span>-->
                    </div>
                    <div class="form-group">
                      <!-- <label for="newpwd">Password</label>-->
                      <input type="password" class="form-control" id="rpassword" placeholder="Password" name="password" required minlength="6">

                    </div>
                    <div class="form-group">
                      <!--  <label for="fullname">Full Name</label>-->
                      <input type="fullname" class="form-control" id="rfullname" placeholder="Full Name" name="fullname" required minlength="5" pattern="[A-Za-z ]{5,}" title="Fullname must be all alphabets with at least 5 characters">

                    </div>
                    <div class="text-center">
                      <input type="submit" name="regRec_btn" class="btn btn-success submit mb-4 px-5" value="sign Up">
                    </div>
                  </form>
                  <div class="success-message" id="register-success-message"
       style="display: none"></div>
   <div class="error-message" id="register-error-message"
       style="display: none"></div>

                </div>
              </div>

              <!--Collector-->
              <div id="menu1" class="tab-pane fade">
                <div class="signup-form profile">
                  <form action="signUpColl.php" method="post" name="registration" id="c-registration">
                    <div class="form-group ">
                      <!--  <label for="name">Username</label>-->
                      <input type="text" class="form-control" id="cname" placeholder="Username" name="username" required minlength="4" pattern="[A-Za-z0-9]+" title="Username must be alphanumeric">
                      <!--<span id="span"> </span>-->
                    </div>
                    <div class="form-group">
                      <!--  <label for="password">Password</label>-->
                      <input type="password" class="form-control" id="cpassword" placeholder="Password" name="password"  required minlength="6">
                        <!--<span id="span"> </span>-->

                    </div>
                    <div class="form-group">
                      <!--  <label for="fullname">Full Name</label>-->
                      <input type="text" class="form-control" id="cfullname" placeholder="Full Name" name="fullname" required minlength="5" pattern="[A-Za-z ]{5,}" title="Fullname must be all alphabets with at least 5 characters">
                    <!--<span id="span" class="error"></span>-->
                    </div>
                    <div class="form-group">
                      <!--<label for="email">Address</label>-->
                      <input type="text" class="form-control" id="caddress" placeholder="Address" name="address" required minlength="10">

                    </div>
                    <div class="form-group ">
                      <!--<label for="materials">Materials</label>-->

                      <select name="materials" class="form-control " required="true">
                        <option disabled="disabled" selected="selected" value="">Choose materials </option>
                        <?php if(!empty($arr_mat)) { ?>
                            <?php foreach($arr_mat as $mat) {?>
                                <?php
								                          echo "<option value='". $mat['materialID']."'>" . $mat['materialID']. ", ".$mat['materialName'].'</option>'; ?>
                							<?php } ?>
                						<?php }  ?>

                      </select>
                    </div>
                    <div class="form-group ">

                    <!--  <select id="days" multiple>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="audi">Audi</option>
                     </select>-->
                      Monday <input type="checkbox" name="day[]" id="day" value="Monday">
                      Tuesday <input type="checkbox" name="day[]" id="day" value="Tuesday">
                      Wednesday <input type="checkbox" name="day[]" id="day" value="Wednesday">
                     Thursday <input type="checkbox" name="day[]" id="day" value="Thursday">
                     Friday <input type="checkbox" name="day[]" id="day" value="Friday">


                    </div>
                    <div class="form-group ">
                      <!--<label for="materials">Materials</label>-->
                      <?php
                      function get_times( $default = '08:00', $interval = '+30 minutes' ) {
                          //$dates = array("", "Mon", "Tues", "Wed", "Thurs", "Fri", "Satur", "Sun");

                          $output = '';

                          $current = strtotime( '08:00' );
                          $end = strtotime( '20:00' );

                          while( $current <= $end ) {
                              $time = date( 'H:i', $current );
                              $sel = ( $time == $default ) ? ' selected' : '';

                            /*  echo date ('l');
                              echo '<option value="'.$optionvalue .'">'.$optionvalue.'</option>';*/
                              $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h.i A', $current ) .'</option>';
                              $current = strtotime( $interval, $current );
                          }

                          return $output;
                      } ?>

                      <select name="time" class="form-control " required="true">
                        <option disabled="disabled" selected="selected" value="">Choose schedule</option>
                        <?php echo get_times(); ?>
                      </select>


                    </div>
                    <div class="text-center ">
                      <input type="submit" name="regColl_btn" value="sign Up">
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
  <!--signup-->

<!--header-->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end ">
          <h1 class="text-uppercase text-white"> Save the Earth</h1>
          <hr class="linedivider my-4 ">
        </div>
        <div class="col-lg-8 align-self-baseline">

          <p class="text-white font-weight-light ">Join us now to be the recycler and collector</p>

          <i class="arrow bounce text-white fa-3x fas fa-angle-double-down mt-5"></i>
        </div>

      </div>
    </div>
  </header>


  <!--aboutUs-->
  <section class="page-section1 " id='about'>
    <div class="container">
      <h2 class="title text-center mt-0">About <span>Us</span></h2>
      <div class="row mbr-justify-content-center">

        <div class="col-lg-6 mbr-col-md-10">
          <div class="wrap">
            <div class="ico-wrap">
              <span class="mbr-iconfont fa-volume-up fa"></span>
            </div>
            <div class="text-wrap vcenter">
              <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Collect <span> Recyclable Material</span></h2>
              <p class="mbr-fonts-style text1 mbr-text display-6">A various type of recyclable material are accepted to recycle in this online platform</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mbr-col-md-10">
          <div class="wrap">
            <div class="ico-wrap">
              <span class="mbr-iconfont fa-calendar fa"></span>
            </div>
            <div class="text-wrap vcenter">
              <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Make
                <span>An Appointment to Recycle</span>
              </h2>
              <p class="mbr-fonts-style text1 mbr-text display-6">Be a recycler and choose the your available date and make appointment with our collectors</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mbr-col-md-10">
          <div class="wrap">
            <div class="ico-wrap">
              <span class="mbr-iconfont fa-globe fa"></span>
            </div>
            <div class="text-wrap vcenter">
              <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Connecting
                <span>With Collectors</span>
              </h2>
              <p class="mbr-fonts-style text1 mbr-text display-6"> A various of collector with multiple recyclable materials be part of this system </p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mbr-col-md-10">
          <div class="wrap">
            <div class="ico-wrap">
              <span class="mbr-iconfont fa-trophy fa"></span>
            </div>
            <div class="text-wrap vcenter">
              <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Achieve <span>Your Targets</span></h2>
              <p class="mbr-fonts-style text1 mbr-text display-6">Accumulate your points of every weight of submitted and collected materials </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--RecycleNow-->
  <section class="page-section " id="recycle">
    <div class="container">
      <h2 class="text-center mt-0">Recycle Now</h2>
      <div class="container cta-100 ">
        <div class="container">
          <div class="row blog">
            <div class="col-md-12">
              <div id="blogCarousel" class="carousel slide container-blog" data-ride="carousel">
                <ol class="carousel-indicators">
                  <?php
                  if(!empty($arr_mat)){
                    $first_dot=true;
                    $c=0;
                    for($i=0;$i<sizeof($arr_mat);$i+=3){
                      if($first_dot){
                        $first_dot=false;
                        echo '<li data-target="#blogCarousel" data-slide-to="'.$c.'" class="active"></li>';
                      }else{
                        echo '<li data-target="#blogCarousel" data-slide-to="'.$c.'"></li>';
                      }
                      $c++;
                    }
                  }
                  ?>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                  <?php
                  if(!empty($arr_mat)){
                    $first_item=true;
                    for($i=0;$i<sizeof($arr_mat);$i+=3){
                      if($first_item){
                        $first_item=false;

                        echo '<div class="carousel-item active">
                                <div class="row">';

                        if( (sizeof($arr_mat)-$i) < 3){
                          $num_loop = sizeof($arr_mat) % 3;
                        }else{
                          $num_loop = 3;
                        }

                        for($j=$i;$j<$num_loop;$j++){
                          $c = $i+$j;
                          echo     '<div class="col-md-4">
                                      <div class="item-box-blog">
                                        <div class="item-box-blog-image">
                                          <!--Image-->
                                          <figure> <img alt="" src="images/material.jpg"> </figure>
                                        </div>
                                        <div class="item-box-blog-body">
                                          <!--Heading-->
                                          <div class="item-box-blog-heading">
                                            <a href="#" tabindex="0">
                                              <h5>'.$arr_mat[$c]["materialName"].'</h5>
                                            </a>
                                          </div>
                                          <!--Text-->
                                          <div class="item-box-blog-text">
                                            <p>'.$arr_mat[$c]["description"].'</p>
                                          </div>
                                          <div class="mt"> <a href="#" tabindex="0" class="btn bg-blue-ui white read">Recycle</a> </div>
                                          <!--Recycle Button-->
                                        </div>
                                      </div>
                                    </div>';
                        }

                        echo     '</div>
                                <!--.row-->
                              </div>';
                      }else{
                        echo '<div class="carousel-item">
                                <div class="row">';

                        if( (sizeof($arr_mat)-$i) < 3){
                          $num_loop = sizeof($arr_mat) % 3;
                        }else{
                          $num_loop = 3;
                        }

                        for($j=0;$j<$num_loop;$j++){
                          $c = $i+$j;
                          echo     '<div class="col-md-4">
                                      <div class="item-box-blog">
                                        <div class="item-box-blog-image">
                                          <!--Image-->
                                          <figure> <img alt="material icon" src="images/material.jpg"> </figure>
                                        </div>
                                        <div class="item-box-blog-body">
                                          <!--Heading-->
                                          <div class="item-box-blog-heading">
                                            <a href="#" tabindex="0">
                                              <h5>'.$arr_mat[$c]["materialName"].'</h5>
                                            </a>
                                          </div>
                                          <!--Text-->
                                          <div class="item-box-blog-text">
                                            <p>'.$arr_mat[$c]["description"].'</p>
                                          </div>
                                          <div class="mt"> <a href="#" tabindex="0" class="btn bg-blue-ui white read">Recycle</a> </div>
                                          <!--Recycle Button-->
                                        </div>
                                      </div>
                                    </div>';
                        }

                        echo     '</div>
                                <!--.row-->
                              </div>';
                      }
                    }
                  }
                  ?>

                </div>
                <!--.carousel-inner-->
              </div>
              <!--.Carousel-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!---contactUs-->
  <section class="page-section" style="background-color:#f1f4fa;" id="contact">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">Let's Get In Touch</h2>
          <hr class="divider my-4">
          <p class="text-muted mb-5">Need assistance? Give us a call or send us an email and we will get bak to you as soon as possible.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div class="pb-5"> +03 2617 9000</div>
        </div>
        <div class="col-lg-4 mr-auto pb-5 text-center ">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <a class="d-block text-decoration-none text-dark" href="mailto:contact@yourwebsite.com">onePlanet@gmail.com</a>
        </div>
        <div class="col-lg-4 mr-auto pb-5 justify-content-center text-center">
          <ul class="social_section_1info">
            <li class="mb-3 facebook"> <a class="fb-ic">
                <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a></li>
            <li class="mb-3 twitter"> <a class="tw-ic">
                <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a></li>
            <li class="mb-3 google"> <a class="gplus-ic">
                <i class="fab fa-google-plus-g fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a></li>
            <li class="mb-3 linkedin"> <a class="li-ic">
                <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a></li>
            <li class="mb-3 instagram"><a class="ins-ic">
                <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a></li>
            <li class="mb-3 pinterest"><a class="pin-ic">
                <i class="fab fa-pinterest fa-lg white-text fa-2x"> </i>
              </a></li>
          </ul>
        </div>

      </div>
    </div>
  </section>

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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

  <script src="js/cj.js"></script>
  <script src="js/login-registration.js"></script>
<!--  <script type="text/javascript">
  $(document).ready(function(){

    $("#loginForm").validate();

      $("#registration").validate();

      $("#c-registration").validate();

    $('#rfullname').keypress(function (e) {
			var regex = new RegExp("^[a-zA-Z]+$");
			var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			if (regex.test(str)) {
				return true;
			}
			else
			{
			e.preventDefault();
			$('.error').show();
			$('.error').text('Please enter alphabet characters');
			return false;
			}
		});


    $('#cfullname').keypress(function (e) {
      var regex = new RegExp("^[a-zA-Z]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (regex.test(str)) {
        return true;
      }
      else
      {
      e.preventDefault();
      $('.error').show();
      $('.error').text('Please enter alphabet characters');
      return false;
      }
    });


  });
</script>-->


</body>


</html>
