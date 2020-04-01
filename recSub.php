<?php

session_start();
include("conn.php");

$username = $_SESSION['username'];
/*
$_SESSION['submissionID'] = array();
print_r($_SESSION['submissionID']);
*/


$sql = "SELECT * FROM users WHERE username ='$username'";
$resultset = mysqli_query($conn, $sql);
$userRecord = mysqli_fetch_assoc($resultset);

$sql = "SELECT * FROM material WHERE materialStatus='Available'";
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

/*if(isset($_POST["recycler"])){
    $result='';
    $sqlSearch = "SELECT recycler FROM submission WHERE recycler LIKE '%".$_POST["recycler"]."%'";
    $rec= mysqli_query($conn, $sqlSearch);
    $result='<ul class="list-unstyled">';

    if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_array($result)){
        $result .='<li>'.$row['recycler'].'</li>';
      }
    }else{
        $result .='<li> Username not found </li>';
    }
    $result .= '</ul>';
    echo $result;
  }*/

/*if(isset($_POST['search'])){
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



 <div class="row justify-content-center ">

                       <div class="col-12 col-md-10 col-lg-8 ">

                               <div class="card-body row no-gutters align-items-center">
                                  <h2  class="col-md-5 py-3">Record Submission</h2>
                                   <!--end of col-->
                                   <div class="input-group col-md-7">

                                  <input class="form-control form-control-lg form-control-borderless bg-light" type="text" name="recycler" id="recycler" placeholder="Search reycler username" required=""><i class="fas fa-exclamation-circle errspan fa-2x d-none" id="ico"></i>
                                  <div class="input-group-append">
                                   <button class="btn btn-lg btn-success" type="submit" name="searchbtn" id="searchbtn"> <i class="fas fa-search "></i></button>
                                  </div>
                                   </div>
                                   <!--end of col-->

                                   <!--end of col-->
                               </div>

                       </div>
                       <!--end of col-->
                   </div>


 <div id="info" class="py-5"></div>

<div class="container d-none" id="addSub">
   <div class="row py-4 ">
      <h5 class="pr-3">Unable to find the submission?</h5>
      <button class="btn btn-primary px-3 btnNew" data-toggle="modal" data-target="#newSub"><i class="fas fa-plus-circle"></i> New submission </button>
   </div>
</div>



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
                          <!--  <h5 class=' pb-2'>Please insert the weight of the submission as below</h5>-->

                              <div class="form-group row">
                              <label  class=" col-sm-5 col-form-label">Submission ID</label>
                              <div class="col-sm-7">
                              <input id="txt_sub" name="txt_sub"  class="form-control " type="text" readonly>
                              </div>
                              </div>

                              <div class="form-group row">
                              <label  class=" col-sm-5 col-form-label">Recycler's Username</label>
                              <div class="col-sm-7">
                              <input id="txt_recUn" name="txt_recUn" class="form-control md-5" type="text" readonly>
                            </div>
                            </div>

                            <div class="form-group row">
                            <label  class=" col-sm-5 col-form-label">Material</label>
                            <div class="col-sm-7">
                                <input id="txt_matID" name="txt_matID" class="form-control d-none" type="text" readonly>
                              <input id="txt_mat" name="txt_mat" class="form-control md-5" type="text" readonly>
                            </div>
                            </div>

                            <div class="form-group row">
                            <label  class=" col-sm-5 col-form-label">Weight (kg)</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" name="weightAcc" id="weightAcc" placeholder="Enter weight in numeric" required pattern="[0-9]+([,\.][0-9]+)?" title="Weight must be numeric">
                            </div>
                            </div>
                          </div>

                          <div class="text-center">
                            <input type="submit" name="acceptBtn" id="acceptBtn" value="Submit">
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
                <h6 class='lead pb-2'>Please update the material and weight of the following submission: </h6>
                <!--  <label class="mb-2">Username</label>-->

                <div class="form-group row">
                <label  class=" col-sm-5 col-form-label">Submission ID</label>
                <div class="col-sm-7">
                  <input id="subUp" name="subUp" class="form-control" type="text" readonly>
                </div>
                </div>

                <div class="form-group row">
                <label  class=" col-sm-5 col-form-label">Recycler's Username</label>
                <div class="col-sm-7">
                  <input id="recUp" name="recUp" class="form-control" type="text" readonly>
                </div>
                </div>



                <div class="form-group row">
                <label  class=" col-sm-5 col-form-label">Material</label>
                <div class="col-sm-7">
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

                <div class="form-group row">
                <label  class=" col-sm-5 col-form-label">Weight (kg)</label>
                <div class="col-sm-7">
                <input type="text" class="form-control " name="weight" id="weightUp" placeholder="Enter weight in numeric" required pattern="[0-9]+([,\.][0-9]+)?" title="Weight must be numeric">
                  </div>
                </div>

              </div>

              <div class="text-center">
                <input type="submit" name="updatebtn" id="updatebtn" value="Submit">
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
            <form action="javascript:void(0);" method="POST" name="newSubForm" id="newSubForm" >
              <div class="form-group">
                <h6 class='lead pb-2'>Please fill up the submission details as below:</h6>
                <!--  <label class="mb-2">Username</label>-->

                <div class="form-group row">
                <label  class=" col-sm-5 col-form-label">Recycler's Username</label>
                <div class="col-sm-7">
                  <select id="recyclerNew" name="recyclerNew" class="form-control " required="true">
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
              <!--    <label id="lblNewRec" class="lead" style="color:red"></label>-->
              </div>
              <div class="form-group">
                <div class="form-group row">
                <label  class=" col-sm-5 col-form-label">Material</label>
                <div class="col-sm-7">
                  <select id="materialNew" name="materialNew" class="form-control " required="true">
                    <option disabled="disabled" selected="selected" value="">Choose materials </option>
                      <!-- <option disabled="disabled" selected="selected" value="">Choose materials </option>
                        <?php if(!empty($arr_mat)) { ?>
                        <?php foreach($arr_mat as $mat) {?>
                            <?php
                                      echo "<option value='". $mat['materialID']."'>" . $mat['materialID']. ", ".$mat['materialName'].'</option>'; ?>
                          <?php } ?>
                        <?php }  ?>-->

                  </select>
                </div>
              </div>
                <!--  <label id="lblNewMat" class="lead" style="color:red"></label>-->
              </div>

              <div class="form-group">
                <!--<label class="mb-2">Password</label>-->
                <div class="form-group row">
                <label  class=" col-sm-5 col-form-label">Weight (kg)</label>
                <div class="col-sm-7">
                <input type="text" class="form-control " name="weightNew" id="weightNew" placeholder="Enter weight in numeric" required pattern="[0-9]+([,\.][0-9]+)?" title="Weight must be numeric">
                </div>
              </div>
              <!--  <label id="lblNewWgt" class="lead" style="color:red"></label>-->
              </div>
              <span id="resultNew"></span>
              <div class="text-center">
                <input type="submit" name="newBtn" id="newBtn" value="Submit">
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
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script type="text/javascript">



       $(document).on('click','#newBtn',function(){

          var name=$("select#recyclerNew").val();
          var mat=$("select#materialNew").val();
          var w=$("input#weightNew").val();

          var intRegex = /^\d+$/;
          var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;


          console.log(name,mat,w);

          if(name==null){
              alert("Please select a recycler");
          }else if(mat==null){
            alert("Please select a material");
          }else if(w==""){
          alert("Please enter weight in kg");
          }else{
            if(intRegex.test(w) || floatRegex.test(w)) {
            $.ajax({
              url:"newSub.php",
              type:"post",
              data:{recycler:name, materialID:mat, weightInKg:w},
              success: function(data){
                  alert(data);
              $('#newSub').modal('hide');
              location.reload();

              }
            });
          }else{
            alert('Please enter valid weight in kg');
          }

           }
          });

          $('#recyclerNew').change(function(){
          var recyclerNew= $(this).val();

            $.ajax({
              url:"matNew.php",
              type:"post",
              data:{recycler:recyclerNew},
              success: function(data){
                  alert(data);
                  $('#materialNew').html(data);
                //  $('#Sub').modal('hide');
                  //  location.reload();
              }
            });

          });



       $('button#searchbtn').on('click',function(){

        var name= $('input#recycler').val();
        var add = document.getElementById('addSub');
        var icon=  document.getElementById('ico');

        if($.trim(name)!=""){
          $.post('fetch.php', {recycler:name}, function(data){
           $('div#info').html(data);
            add.classList.remove("d-none");

          });
        }else{
          $('input#recycler').focus();
        //  icon.classList.remove("d-none");
        }

       });

       $('#info').on('click',".btnAccept",function(){
                //get data from table row


                //open modal
                $("#acceptSub").modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#txt_recUn').val(data[0]);
                $('#txt_sub').val(data[1]);
                $('#txt_matID').val(data[2]);
                $('#txt_mat').val(data[3]);
        });

       $(document).on('click','#acceptBtn',function(){

         var rec= $('input#txt_recUn').val();
         var sub= $('input#txt_sub').val();
         var mat= $('input#txt_matID').val();
         var w= $('input#weightAcc').val();

         var intRegex = /^\d+$/;
         var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;


           console.log(rec,sub,mat,w);

           if(w==""){
           alert("Please enter weight in kg");
           }else{
                 if(intRegex.test(w) || floatRegex.test(w)) {
               $.ajax({
                 url:"accept.php",
                 type:"post",
                 data:{recycler:rec, submissionID:sub, materialID:mat, weightInKg:w},
                 success: function(data){
                     alert(data);
                     $('#acceptSub').modal('hide');
                       location.reload();
                 }
               });
             }else{
               alert('Please enter valid weight in kg');
             }
            }
        });

        $('#info').on('click',".btnUpdate",function(){
                 //get data from table row

                 //open modal
                 $("#updateSub").modal('show');
                 $tr = $(this).closest('tr');

                 var data = $tr.children("td").map(function() {
                     return $(this).text();
                 }).get();

                 console.log(data);


                 $('#recUp').val(data[0]);
                 $('#subUp').val(data[1]);


                 $("#cmat option").each(function(){
                  if ($(this).val() == data[2]) {
                    //$(this).attr("disabled", "disabled").siblings().removeAttr("disabled");
                    $(this).hide().siblings().show();
                    //attr("disabled", "disabled").siblings().removeAttr("disabled");
                  }
                  });



         });

        $(document).on('click','#updatebtn',function(){

          var rec=$('input#recUp').val();
          var sub= $('input#subUp').val();
          var mat= $('select#cmat').val();
          var w= $('input#weightUp').val();

          var intRegex = /^\d+$/;
          var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

            console.log(rec,sub,mat,w);

          if(mat==null){
            alert("Please select a material");
          }else if(w==""){
             alert("Please enter weight in kg");
          }else{
            if(intRegex.test(w) || floatRegex.test(w)) {
              $.ajax({
                url:"updateSub.php",
                type:"post",
                data:{recycler:rec, submissionID:sub, materialID:mat, weightInKg:w},
                success: function(data){
                    alert(data);
                    $('#updateSub').modal('hide');
                      location.reload();
                }
              });
            }else{
              alert('Please enter valid weight in kg');
            }

             }
         });
       </script>


       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <script src="js/cj.js"></script>

  </body>


  </html>
