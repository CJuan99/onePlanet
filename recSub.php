<?php

session_start();
include("conn.php");

$username = $_SESSION['username'];


$sql = "SELECT * FROM users WHERE username ='$username'";
$resultset = mysqli_query($conn, $sql);
$userRecord = mysqli_fetch_assoc($resultset);

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

$sql2 = "SELECT username FROM users WHERE userType ='Recycler'";
$resultRec =  $conn->query($sql2);
$arr_rec= [];

if ($resultRec->num_rows > 0) {
    $arr_rec = $resultRec->fetch_all(MYSQLI_ASSOC);
}

  $output ='';

if(isset($_POST['search'])){
  $searchq= $_POST['search'];
  $searchq= preg_replace("#[^0-9a-z]#i","",$searchq);
  $sqlSearch= "SELECT * FROM submission, material WHERE submission.materialID = material.materialID AND recycler LIKE '%".$searchq."%'";



  $resultSearch =  $conn->query($sqlSearch);


  if($resultSearch->num_rows > 0){
    $output .= '
    <h5>Searching "'.$searchq.'" </h5>
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
    while($row = $resultSearch->fetch_assoc()){

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

  }
  else
  {
   $output ='
     <h5>Searching "'.$searchq.'" </h5>
   <div class="bg-light py-3 px-3" ><h5> Data Not Found</h5></div>
   <div class="container ">
   <div class="row py-4 ">
       <h5 class="pr-3">Unable to find the submission?</h5>
       <button class="btn btn-primary px-3" data-toggle="modal" data-target="#newSub"><i class="fas fa-plus-circle"></i> New submission </button>
   </div>
   </div>
  ';
  }


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
  <title>My Collection</title>
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
                <a class="nav-link js-scroll-trigger" href="">My Collection</a>
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
    <h1 class="display-3"><?php echo  $userRecord['username'];?> 's </h1>
    <p class="lead">Collection</p>
</div>


<div class="container">

 <h2 align="center" class="py-3">Record Submission</h2>
 <form  action="recSub.php" method="POST">
 <div class="row justify-content-center ">
                       <div class="col-12 col-md-10 col-lg-8 bg-active">
                           <form class="card card-sm">
                               <div class="card-body row no-gutters align-items-center">

                                   <!--end of col-->
                                   <div class="col">
                                  <input class="form-control form-control-lg form-control-borderless bg-light" type="text" name="search" placeholder="Search reycler username">
                                   </div>
                                   <!--end of col-->
                                   <div class="col-auto">
                                       <button class="btn btn-lg btn-success" type="submit" name="searchbtn"> <i class="fas fa-search "></i></button>
                                   </div>
                                   <!--end of col-->
                               </div>
                           </form>
                       </div>
                       <!--end of col-->
                   </div>


 <!--<div class="card-body row align-items-center">
     <div class="col-auto">
         <i class="fas fa-search h4 text-body"></i>
     </div>

     <div class="col">
          <input class="form-control form-control-lg form-control-borderless" type="text" name="search" placeholder="Search reycler username">
     </div>

     <div class="col-auto">
           <button class="btn btn-lg btn-success" type="submit" name="searchbtn">Search</button>
     </div>
 </div>-->

 <div id="result" class="py-5"> <?php   echo ''.$output.'</table></div>'; ?></div>

</form>


</div>



  <!--acceptModal-->

  <div class="modal fade" id="acceptSub" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content shadow-lg rounded">
                  <div class=" text-center py-3 ">
                    <button type="button" class="close pr-2 text-success" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-success">Confirmation</h4>

                  </div>
                  <div class="modal-body">
                    <div class="login px-2 mx-auto mw-100 ">
                      <div class="signup-form profile">
                        <form action="javascript:void(0);" method="POST" name="acceptForm" id="acceptForm">
                          <div class="form-group">
                            <h6 class='lead pb-2'>Please insert the weight of the submission</h6>
                            <!--  <label class="mb-2">Username</label>-->
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text">Weight (kg)</div>
                              </div>
                              <input type="text" class="form-control" name="weight" id="weightCon" placeholder="Enter weight in numeric" required pattern="[0-9]+([,\.][0-9]+)?" title="Weight must be numeric">
                            </div>
                          </div>
                          <!--  <div class="form-group">
                          <label class="mb-2">Password</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key icon text-default"></i></span>
                              </div>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required minlength="6">
                            </div>

                          </div>-->
                          <div class="text-center">
                            <input type="submit" name="acceptBtn" value="Submit">
                          </div>
                          <p class="text-center pb-4">
                            <span>Don't match the submission's material? </span>

                            <a class="text-decoration-none text-success" href="#" data-toggle="modal" data-target="#updateSub" data-dismiss="modal">Click here to update</a>
                          </p>
                        </form>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
  <!--accpetModal>

<!--updateModal-->

<div class="modal fade" id="updateSub" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow-lg rounded">
      <div class=" text-center py-3 ">
        <button type="button" class="close pr-2 text-success" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-success">Update Material</h4>

      </div>
      <div class="modal-body">
        <div class="login px-2 mx-auto mw-100 ">
          <div class="signup-form profile">
            <form action="javascript:void(0);" method="POST" name="updateForm" id="updateForm" >
              <div class="form-group">
                <h6 class='lead pb-2'>Please update the collected material</h6>
                <!--  <label class="mb-2">Username</label>-->
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text pr-4">Materials</div>
                  </div>
                  <select id="cmat" name="materials" class="form-control " required="true">
                    <option disabled="disabled" selected="selected" value="">Choose materials </option>
                    <?php if(!empty($arr_mat)) { ?>
                        <?php foreach($arr_mat as $mat) {?>
                            <?php
                                      echo "<option value='". $mat['materialID']."'>" . $mat['materialID']. ", ".$mat['materialName'].'</option>'; ?>
                          <?php } ?>
                        <?php }  ?>

                  </select>
                </div>

              </div>
              <div class="form-group">
                <!--<label class="mb-2">Password</label>-->
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text pr-2">Weight (kg)</span>
                  </div>
              <input type="text" class="form-control " name="weight" id="weightUp" placeholder="Enter weight in numeric" required pattern="[0-9]+([,\.][0-9]+)?" title="Weight must be numeric">
                </div>

              </div>
              <div class="text-center">
                <input type="submit" name="updatebtn" value="Submit">
              </div>
              <p class="text-center pb-4">
                <span>Don't match the submission? </span>
                <a class="text-decoration-none text-success" href="#" data-toggle="modal" data-target="#newSub" data-dismiss="modal">Click here to add submission</a>
              </p>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!--updateModal>

<!-newSub modal-->
<div class="modal fade" id="newSub" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow-lg rounded">
      <div class=" text-center py-3 ">
        <button type="button" class="close pr-2 text-success" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-success">New Submission</h4>

      </div>
      <div class="modal-body">
        <div class="login px-2 mx-auto mw-100 ">
          <div class="signup-form profile">
            <form action="javascript:void(0);" method="POST" name="updateForm" id="updateForm" >
              <div class="form-group">
                <h6 class='lead pb-2'>Please fill up the submission details as below:</h6>
                <!--  <label class="mb-2">Username</label>-->

                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text pr-4 ">Recycler</div>
                  </div>
                  <select id="rec" name="recycler" class="form-control " required="true">
                    <option disabled="disabled" selected="selected" value="">Choose recycler </option>
                    <?php if(!empty($arr_rec)) { ?>
                        <?php foreach($arr_rec as $rec) {?>
                            <?php
                                      echo "<option value='". $rec['username']."'>" . $rec['username']. '</option>'; ?>
                          <?php } ?>
                        <?php }  ?>

                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group ">
                  <div class="input-group-prepend">
                    <div class="input-group-text pr-4">Materials</div>
                  </div>
                  <select id="mat" name="materials" class="form-control " required="true">
                    <option disabled="disabled" selected="selected" value="">Choose materials </option>
                    <?php if(!empty($arr_mat)) { ?>
                        <?php foreach($arr_mat as $mat) {?>
                            <?php
                                      echo "<option value='". $mat['materialID']."'>" . $mat['materialID']. ", ".$mat['materialName'].'</option>'; ?>
                          <?php } ?>
                        <?php }  ?>

                  </select>
                </div>
              </div>


              <div class="form-group">
                <!--<label class="mb-2">Password</label>-->
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text pr-2">Weight (kg)</span>
                  </div>
              <input type="text" class="form-control " name="weight" id="weight" placeholder="Enter weight in numeric" required pattern="[0-9]+([,\.][0-9]+)?" title="Weight must be numeric">
                </div>

              </div>
              <div class="text-center">
                <input type="submit" name="newBtn" value="Submit">
              </div>
            <!--  <p class="text-center pb-4">
                <span>Don't match the submission? </span>
                <a class="text-decoration-none text-success" href="#" data-toggle="modal" data-target="#newSub" data-dismiss="modal">Click here to add submission</a>
              </p>-->
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!--newSub Modal
      <div class="modal fade" id="newSub" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="bg-dark text-light text-center py-3 " >
                 <button type="button" class="close pr-2 text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                <h4 class="modal-title">Add Material</h4>
              </div>
              <div class="modal-body">
                <div class="px-2 mx-auto mw-100">
                  <form action="addMaterial.php" method="POST">
                    <div class="form-group">
                      <label class="mb-2">Material Name</label>
                      <input type="text" class="form-control" name="materialName" id="materialName" placeholder="Material Name" pattern="[A-Za-z ]{1,}" title="Must contain only alphabet" required>
                    </div>
                    <div class="form-group">
                      <label class="mb-2">Description</label>
                      <input type="text" class="form-control" name="description" id="description" placeholder="Description" pattern=".{20,50}" title="Must contain between 20 to 50 characters" required>
                    </div>
                    <div class="form-group">
                      <label class="mb-2">Points(per kg)</label>
                      <input type="text" class="form-control" name="points" id="points" placeholder="Points" pattern="[0-9]{1,3}" title="Must contain only integer number and less than equal to 3 numbers" required>
                    </div>
                    <div class="text-center">
                      <button type="submit" name="addBtn" class="btn btn-success submit mb-4 px-5" value="add">Add</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      newSub Modal-->




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
  <!--  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-demo.js"></script-->


  </body>


  </html>
