<?php

session_start();
include("conn.php");

$username = $_SESSION['username'];


$sql = "SELECT * FROM users WHERE username ='$username'";
$resultset = mysqli_query($conn, $sql);
$userRecord = mysqli_fetch_assoc($resultset);

$sqlCollMat = "SELECT materialName FROM registeredmaterial, material
 WHERE registeredmaterial.materialID= material.materialID AND registeredmaterial.username ='$username'";


 $resultColl = $conn->query($sqlCollMat);
 $arr_coll= [];

 if ($resultColl->num_rows > 0) {
     $arr_coll = $resultColl->fetch_all(MYSQLI_ASSOC);
 }


$sql = "SELECT * FROM material";
$result = $conn->query($sql);
$arr_mat= [];

if ($result->num_rows > 0) {
    $arr_mat = $result->fetch_all(MYSQLI_ASSOC);
}





$sqlSub = "SELECT material.materialID, materialName, description, pointsPerKg FROM submission, material WHERE submission.materialID = material.materialID AND recycler='$username'";
$resultSub = $conn->query($sqlSub);
$arr_sub= [];

if ($resultSub->num_rows > 0) {
    $arr_sub = $resultSub->fetch_all(MYSQLI_ASSOC);
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
  <title>Recycler Profile</title>
  <link rel="icon" href="images/favicon.ico" type="image/ico">
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

                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger " href="index.php#about">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php#recycle">Recycle Now</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact Us</a>
                  </li>

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
                          <li class="list-group-item text-left"><span class="pull-left"><strong>Submission</strong></span> <span class="badge bg-warning text-white">3</span></li>
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
                                      <h6 class="proile-rating lead ">Eco Level: <span>  <?php echo $userRecord['ecoLevel'];?></span></h6>

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
                                            <input type="password"  readonly class="form-control-plaintext" id="rec_password" required minlength="6" name="password" value="******">
                                          </div>
                                            <div class="col-sm-2 col-md-2 col-2" >
                                              <input id="pd_edit" type="button" value="Edit">
                                            <!--  <a href="" id="edit" >Edit</a>-->
                                            </div>
                                          <!--  <input id="name" name="name" placeholder="First Name" class="form-control here" type="text">-->
                                        </div>



                                        <div class="row py-3">
                                         <div class="col-sm-3 col-md-3 col-5">
                                         <label class="font-weight-bold">Fullname</label>
                                       </div>
                                         <div class="col-sm-7 col-md-7 col-5">
                                           <h5 id="rec_txtFn"><?php echo  $userRecord['fullname'];?></h5>
                                             <input type="text"  class="form-control-plaintext d-none" id="rec_Fn" name="fullname" required minlength="5" value="<?php echo  $userRecord['fullname'];?>"  pattern="[A-Za-z ]{5,}" title="Fullname must be all alphabets with at least 5 characters" >

                                         </div>
                                           <div  class="col-sm-2 col-md-2 col-2">
                                            <!-- <a href="" id="edit" >Edit</a>-->
                                            <input id="fn_edit" type="button" value="Edit">

                                           </div>
                                       </div>
                                       <div class="row " >
                                        <div class="text-center w-100 pt-4">
                                           <button class="btn btn-secondary py-2 px-4 mr-5 text-uppercase float-right d-none" id="btncancelRec" name="btncancelRec" type="button" value="Cancel"  >Cancel</button>
                                           <button class="btn btn-success py-2 px-4 mr-5 text-uppercase float-right d-none" id="btnsaveRec" name="btnsubmitRec" type="submit" value="Submit"  >Save</button>

                                         </div>
                                         </div>
                                       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
                                       <script type="text/javascript">

                                        var ebtn  = document.getElementById('pd_edit');
                                        var recp = document.getElementById('rec_password');

                                        var fnbtn  = document.getElementById('fn_edit');
                                        var rectxt = document.getElementById('rec_txtFn');
                                        var recFn = document.getElementById('rec_Fn');


                                        var saveRec = document.getElementById('btnsaveRec');
                                        var cancelRec =  document.getElementById('btncancelRec');


                                        ebtn.addEventListener('click', function(){
                                            recp.readOnly=false;
                                            recp.value='';
                                            saveRec.style.display="inline";

                                            recp.focus(); // set the focus on the editable field
                                            saveRec.classList.remove("d-none");
                                            cancelRec.classList.remove("d-none");


                                        });


                                        fnbtn.addEventListener('click', function(){
                                            //inp.disabled = false;

                                          //  alert("Account is successfully updated");
                                            rectxt.style.display="none";

                                            recFn.classList.remove("d-none");
                                            recFn.focus();
                                            saveRec.classList.remove("d-none");
                                            cancelRec.classList.remove("d-none");

                                        });

                                        cancelRec.addEventListener('click', function(){
                                          recp.readOnly=true;

                                          rectxt.style.display="block";
                                          recFn.classList.add("d-none");

                                           window.location.reload();
                                        });



                                jQuery(document).ready(function(){
                                    $('#editProfile').submit(function(){

                                          var pwd=recp.value;
                                          var fullname=recFn.value;
                                          var error="true";

                                          console.log(editProfile.submit());

                                          var xmlhttp = new XMLHttpRequest();

                                      xmlhttp.onreadystatechange = function() {
                                          if (this.readyState == 4 && this.status == 200) {
                                            error=this.responseText;
                                            if (error){
                                              alert("Account is successfully updated");
                                              window.location.reload();
                                            }else{
                                              alert("Cannot update");
                                              window.location.reload();
                                            }
                                          }
                                        };

                                        xmlhttp.open("GET", "update.php?fullname="+fullname+"&password="+pwd , true);
                                        xmlhttp.send();
                                      /*  if (error="true"){
                                          alert("Account is successfully updated");
                                           //window.location.reload();
                                        }else{
                                          alert("Cannot update");
                                           //window.location.reload();
                                        }*/
                                      });
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
                                       <div class="row">
                                              <div class="col-md-6">
                                                  <label>Choose the submitted materials</label>
                                              </div>
                                              <div class="col-md-6">
                                                <select name="materials" class="form-control "  id="selectMat">
                                                  <option disabled="disabled" selected="selected" value="">Choose materials </option>
                                                  <?php if(!empty($arr_sub)) { ?>
                                                      <?php foreach($arr_sub as $sub) {?>
                                                          <?php
                                                                    echo "<option value='". $sub['materialID']."'>" . $sub['materialID']. ", ".$sub['materialName']. ", ".$sub['description'].", ".$sub['pointsPerKg'].'</option>'; ?>
                                                                    $sub['materialID'] = $_SESSION['materialID'];
                                                                    $sub['materialName']=$_SESSION['materialName'];
                                                        <?php } ?>
                                                      <?php }  ?>

                                                </select>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-12 py-3">
                                                    <button class="btn btn-success py-2 px-3 text-uppercase ml-auto float-right" id="btnOk" name="btnOk" type="submit" value="Ok"  onclick="window.location.href='viewHistory.php'">Ok</button>
                                              </div>

                                          </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>


    <script src="js/cj.js"></script>


  </body>


  </html>
