<?php

session_start();
include("conn.php");

$username = $_SESSION['username'];


$sql = "SELECT * FROM users WHERE username ='$username'";
$resultset = mysqli_query($conn, $sql);
$userRecord = mysqli_fetch_assoc($resultset);

/*$sqlColl = "SELECT submissionID, materialName, proposedDate FROM submission, material
 WHERE submission.submissionID= material.submissionID
 AND collector ='$username'";


 $resultColl = $conn->query($sqlColl);
 $arr_coll= [];

 if ($resultColl->num_rows > 0) {
     $arr_coll = $resultColl->fetch_all(MYSQLI_ASSOC);
 }
*/

/*$sql = "SELECT materialName FROM material where materialID";
$result = $conn->query($sql);
$arr_mat= [];

if ($result->num_rows > 0) {
    $arr_mat = $result->fetch_all(MYSQLI_ASSOC);
}*/




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
  <title>My Collection</title>
  <link rel="icon" href="images/favicon.ico" type="image/ico">
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/ricky.css" rel="stylesheet" />

  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
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
                    <a class="nav-link js-scroll-trigger" href="index.php#recycle">My Collection</a>
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

    <!--profile-->

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                  <!--    <h2 class="mt-4">Maintain Material Type</h2>-->
                <!--  <div class="d-flex justify-content-center h-100">
                 <div class="searchbar">
                   <input class="search_input" type="text" name="" placeholder="Search...">
                   <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                 </div>
               </div>-->
                <!--  <div class="container">-->

                  	<div class="row justify-content-center">
                      <div class="col-12 col-md-10 col-lg-8">
                          <form class="card card-sm searchB bg-transparent">
                              <div class="card-body row align-items-center">
                                  <div class="col-auto">
                                      <i class="fas fa-search h4 text-body"></i>
                                  </div>
                                  <!--end of col-->
                                  <div class="col">
                                      <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search reycler username">
                                  </div>
                                  <!--end of col-->
                                  <div class="col-auto">
                                      <button class="btn btn-lg btn-success" type="submit">Search</button>
                                  </div>
                                  <!--end of col-->
                              </div>
                          </form>
                      </div>
                      <!--end of col-->
                  </div>
              <!--  </div>-->
                      <div class="card mb-4 mt-3">
                      <!--    <div class="card-header"><i class="fas fa-table mr-1"></i>My Collection   <button class="btn btn-success squareBtn py-0 px-2 float-right" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button></div>-->
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                          <tr>
                                              <th>Submission ID</th>
                                              <th>Material Name</th>
                                              <th>Proposed Date</th>
                                              <th>Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $sql_Materials = "SELECT submissionID, materialName, proposedDate FROM submission, material
                                           WHERE submission.materialID= material.materialID
                                           AND collector ='$username'";
                                          $results = $conn->query($sql_Materials);
                                          if($results->num_rows > 0){
                                            while($row = $results->fetch_assoc()){
                                              echo '<tr>
                                                        <td class="w-25 p-1">'.$row["submissionID"].'</td>
                                                        <td class="w-25 p-3">'.$row["materialName"].'</td>
                                                        <td  class="w-25 p-3" >'.$row["proposedDate"].'</td>

                                                        <td class="buttonGroup text-center">
                                                          <button class="deleteBtn btn btn-danger  px-3 py-1"><i class="far fa-check-circle"></i> Accept</button>
                                                          <button class="btn btn-success px-3 py-1" data-toggle="modal" data-target="#submission"><i class="far fa-edit"></i>Update</button>
                                                        </td>
                                                    </tr>';
                                            }
                                          }
                                        ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="row py-3 px-3">
                              <h5 class="px-3">Can't find the submission?</h5>
                              <button class="btn btn-primary px-3 py-1" data-toggle="modal" data-target="#submission"><i class="fas fa-plus-circle"></i> New submission </button>
                          </div>

                      </div>


                    </div>
                </main>

            </div>


  <!--      <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
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
        </div>-->

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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-demo.js"></script>


  </body>


  </html>
