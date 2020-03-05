<?php

session_start();
include("conn.php");

$username = $_SESSION['username'];


$sql = "SELECT * FROM users WHERE username ='$username'";
$resultset = mysqli_query($conn, $sql);
$userRecord = mysqli_fetch_assoc($resultset);


$sqlnumSub ="SELECT COUNT(*) FROM submission WHERE collector = '$username'";
$resultSub= mysqli_query($conn, $sqlnumSub );
if ($resultSub->num_rows > 0) {
    $num = $resultSub->fetch_all(MYSQLI_ASSOC);
}




$sqlCollMat = "SELECT materialName FROM registeredmaterial, material
 WHERE registeredmaterial.materialID= material.materialID AND registeredmaterial.username ='$username'";


 $resultColl = $conn->query($sqlCollMat);
 $arr_coll= [];

 if ($resultColl->num_rows > 0) {
     $arr_coll = $resultColl->fetch_all(MYSQLI_ASSOC);
 }
/*$resultColl = mysqli_query($conn, $sqlCollMat);
$collRecord = mysqli_fetch_assoc($resultColl);*/



$sql = "SELECT * FROM material";
$result = $conn->query($sql);
$arr_mat= [];

if ($result->num_rows > 0) {
    $arr_mat = $result->fetch_all(MYSQLI_ASSOC);
}




/*if ($resultset->num_rows > 0) {
    $arr_mat = $result->fetch_all(MYSQLI_ASSOC);
}

if(isset($_POST['materialID'])){
	$matID= $_POST['materialID'];
	$_SESSION['materialID']= $matID;
}*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
  <title>Home</title>
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
					<a class="nav-link js-scroll-trigger" href="profile.php " > <span class="fa fa-user mx-3" aria-hidden="true"></span><?php echo $_SESSION['username']; ?></a>
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
    <h1 class="display-3">Welcome to <?php echo  $userRecord['username'];?> 's </h1>
    <p class="lead">Profile</p>
    </div>

    <!--profile-->
    <div class="container emp-profile">
              <!--<form method="post">-->
                  <div class="row">
                      <div class="col-md-3">
                          <div class="profile-img">
                            <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                              <div class="file btn btn-lg btn-primary">
                                  Upload Photo
                                  <input type="file" name="file"/>
                              </div>
                          </div>
                        <ul class="list-group px-2 py-3">
                          <li class="list-group-item text-white bg-success">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                          <?php if(!empty($_SESSION['username'])) {?>
                          <?php  if($_SESSION['userType']=='Recycler')  { ?>
                             <li class="list-group-item text-left"><span class="pull-left"><strong>Submission</strong></span> <span class="badge bg-warning text-white"><?php echo $num ?></span></li>
                            <?php }else { ?>
                                  <li class="list-group-item text-left"><span class="pull-left"><strong>Collection</strong></span> <span class="badge bg-warning text-white">3</span></li>
                            <?php } ?>
                            <?php } ?>

                          <li class="list-group-item text-left"><span class="pull-left"><strong>Materials</strong></span> <span class="badge bg-primary text-white ">2</span></li>

                        </ul>
                        <!--<div class="profile-work">
                            <p>WORK LINK</p>
                            <a href="">Website Link</a><br/>
                            <a href="">Bootsnipp Profile</a><br/>
                            <a href="">Bootply Profile</a>
                            <p>SKILLS</p>
                            <a href="">Web Designer</a><br/>
                            <a href="">Web Developer</a><br/>
                            <a href="">WordPress</a><br/>
                            <a href="">WooCommerce</a><br/>
                            <a href="">PHP, .Net</a><br/>
                        </div>-->
                      </div>
                      <div class="col-md-9">
                          <div class="profile-head">
                                      <h4 class="py-2">
                                        <?php echo  $userRecord['fullname'];?>
                                      </h4>
                                      <h5 >
                                          <?php echo  $userRecord['userType'];?>
                                      </h5 >
                                      <h6 class="proile-rating lead pt-3 ">Total Points: <span>  <?php echo  $userRecord['totalPoints'];?></span></h6>
                                      <?php if(!empty($_SESSION['username'])) { ?>
                                        <?php if($_SESSION['userType']=='Recycler') { ?>
                                            <h6 class="proile-rating lead ">Eco Level: <span>  <?php echo $userRecord['ecoLevel'];?></span></h6>
                                          <?php } ?>
                                            <?php } ?>
                              <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">History</a>
                                  </li>
                              </ul>
                          </div>


                          <div class="tab-content profile-tab" id="myTabContent">
                              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form  action="javascript:void(0)"  method="" enctype="multipart/form-data" name="editProfile" id="editProfile" >
                                      <div class=" row ">
                                        <div class="col-sm-3 col-md-3 col-5">
                                        <label class="font-weight-bold" >Username</label>
                                      </div>
                                        <div class="col-md-8 col-6">
                                            <h5><?php echo  $userRecord['username'];?></h5>
                                            <?php $_SESSION['username']=$userRecord['username'];?>
                                        </div>

                                      </div>


                                      <div class="row py-3">
                                        <div class="col-sm-3 col-md-3 col-5">
                                        <label class="font-weight-bold">Password</label>
                                      </div>
                                        <div class="col-sm-7 col-md-7 col-5">
                                          <input type="password"  readonly class="form-control-plaintext" id="password" required minlength="6" name="password" value="<?php echo  $userRecord['password'];?>">
                                        </div>
                                          <div class="col-sm-2 col-md-2 col-2" >
                                            <input id="edit" type="button" value="Edit">
                                          <!--  <a href="" id="edit" >Edit</a>-->
                                          </div>
                                        <!--  <input id="name" name="name" placeholder="First Name" class="form-control here" type="text">-->
                                      </div>



                                      <div class="row py-3">
                                       <div class="col-sm-3 col-md-3 col-5">
                                       <label class="font-weight-bold">Fullname</label>
                                     </div>
                                       <div class="col-sm-7 col-md-7 col-5">
                                         <h5 id="txtFn"><?php echo  $userRecord['fullname'];?></h5>
                                           <input type="text"  class="form-control-plaintext d-none" id="myFn" name="fullname" required minlength="5" value="<?php echo  $userRecord['fullname'];?>" >

                                       </div>
                                         <div  class="col-sm-2 col-md-2 col-2">
                                          <!-- <a href="" id="edit" >Edit</a>-->
                                          <input id="editFn" type="button" value="Edit">

                                         </div>
                                     </div>
                                  <?php if(!empty($_SESSION['username'])) { ?>
                                       <?php if($_SESSION['userType']=='Collector') { ?>
                                       <div class="row py-3">
                                        <div class="col-sm-3 col-md-3 col-5">
                                        <label class="font-weight-bold">Schedule</label>
                                      </div>
                                        <div class="col-md-2 col-4">
                                            <h5><?php echo  $userRecord['day']?></h5>
                                        </div>
                                        <div class="col-sm-3 col-md-5 col-3">
                                            <h5><?php echo  $userRecord['schedule']?></h5>
                                        </div>
                                      </div>

                                      <div class="row py-3">
                                         <div class="col-sm-3 col-md-3 col-5">
                                         <label class="font-weight-bold">Materials</label>
                                       </div>
                                         <div class="col-md-8 col-6">
                                           <?php if(!empty($arr_coll)) {
                                             foreach($arr_coll as $coll) {
                                                  $matID = $coll['materialName'];
                                                  //echo $matID;
                                                 echo "<h5>".$matID."</h5>";
                                                  }
                                                }?>

                                              <small><button type="button" class="text-decoration-none" id="myMat" ><i class="fas fa-plus pr-2"></i> Materials </button> </small>
                                              <select name="materials" class="form-control d-none"  id="selectMat">
                                                <option disabled="disabled" selected="selected" value="">Choose materials </option>
                                                <?php if(!empty($arr_mat)) { ?>
                                                    <?php foreach($arr_mat as $mat) {?>
                                                        <?php
                                                                  echo "<option value='". $mat['materialID']."'>" . $mat['materialID']. ", ".$mat['materialName']. ", ".$mat['description'].", ".$mat['pointsPerKg'].'</option>'; ?>
                                                      <?php } ?>
                                                    <?php }  ?>

                                              </select>
                                         </div>
                                        </div>
                                        <div class="text-center " >
                                          <button class="btn btn-success py-2 px-3 text-uppercase float-right d-none" id="btnsave" name="btnsubmitColl" type="submit" value="Submit"  >Save</button>
                                            <button class="btn btn-success py-2 px-3 text-uppercase float-right" id="btncancelColl" name="btncancelColl" type="submit" value="Cancel"  >Cancel</button>
                                        </div>
                                        <?php } ?>
                                          <?php } ?>

                                       <div class="text-center " >
                                         <button class="btn btn-success py-2 px-3 text-uppercase float-right d-none" id="btnsaveRec" name="btnsubmit" type="submit" value="Submit"  >Save</button>
                                         <button class="btn btn-success py-2 px-3 text-uppercase float-right d-none" id="btncancel" name="btncancelColl" type="submit" value="Cancel"  >Save</button>
                                       </div>

                                       <script type="text/javascript">
                                       var el  = document.getElementById('edit');
                                        var inp = document.getElementById('password');
                                         var eF  = document.getElementById('editFn');
                                         var txtFn = document.getElementById('txtFn');
                                        var fn = document.getElementById('myFn');
                                        var matAdd = document.getElementById('myMat');
                                        var selectMat = document.getElementById("selectMat")

                                        var save = document.getElementById('btnsave');

                                        el.addEventListener('click', function(){
                                            inp.readOnly=false;
                                              ///inp.value='';
                                            save.style.display="block";

                                            inp.focus(); // set the focus on the editable field
                                            save.classList.remove("d-none");
                                          //  fn.classList.remove("d-none");


                                        });

                                        eF.addEventListener('click', function(){
                                            //inp.disabled = false;

                                          //  alert("Account is successfully updated");
                                            txtFn.style.display="none";

                                            // set the focus on the editable field

                                          fn.classList.remove("d-none");
                                          fn.focus();
                                          save.classList.remove("d-none");

                                        });


                                        matAdd.addEventListener('click', function(){

                                            matAdd.style.display="none";

                                            // set the focus on the editable field

                                          selectMat.classList.remove("d-none");
                                          selectMat.required= true;
                                          save.classList.remove("d-none");

                                            var xmlhttp = new XMLHttpRequest();


                                        });

                                        save.addEventListener('click', function(){

                                          var pwd=inp.value;
                                          var fullname=fn.value;
                                          var mat=selectMat.value;
                                          var error="true";

                                       var xmlhttp = new XMLHttpRequest();

                                      xmlhttp.onreadystatechange = function() {
                                          if (this.readyState == 4 && this.status == 200) {
                                            error=this.responseText;

                                          }
                                        };

                                        xmlhttp.open("GET", "backupupdate.php?fullname="+fullname+"&password="+pwd + "&materialID="+mat, true);
                                        xmlhttp.send();
                                        if (error="true"){
                                          alert("Account is successfully updated");
                                           window.location.reload();
                                        }else{
                                          alert("Cannot update");
                                           window.location.reload();
                                        }


                                      /*  xmlhttp.open("GET", "backupupdate.php?password="+password_Selected, true);
                                        xmlhttp.send();

                                        xmlhttp.open("GET", "backupupdate.php?materialID="+materials_Selected, true);
                                        xmlhttp.send();*/

                                      });

                                       </script>

                                  <!--    <div class="form-group row">
                                        <label for="select" class="col-4 col-form-label">Materials</label>
                                        <div class="col-8">
                                            <p>php <span ><a href="" class="about-item-edit">Edit</a></span></p>

                                        </div>
                                      </div>-->
                                    </form>
                              </div>
                              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                      <!--    <div class="row">
                                              <div class="col-md-6">
                                                  <label>Experience</label>
                                              </div>
                                              <div class="col-md-6">
                                                  <p>Expert</p>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label>Hourly Rate</label>
                                              </div>
                                              <div class="col-md-6">
                                                  <p>10$/hr</p>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label>Total Projects</label>
                                              </div>
                                              <div class="col-md-6">
                                                  <p>230</p>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label>English Level</label>
                                              </div>
                                              <div class="col-md-6">
                                                  <p>Expert</p>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label>Availability</label>
                                              </div>
                                              <div class="col-md-6">
                                                  <p>6 months</p>
                                              </div>
                                          </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <label>Your Bio</label><br/>
                                          <p>Your detail description</p>
                                      </div>
                                  </div>-->
                              </div>
                          </div>

                        <!--details-->

                      </div>
                      <!--<div class="col-md-2">
                          <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                      </div>-->
                  </div>

                          </div>


          <!--profile-->
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


  </body>


  </html>
