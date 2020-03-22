<?php
session_start();
include("maintainMaterial_JS.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>View Submission History - Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/ricky.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="maintainMaterial.php">ONEPLANET - ADMIN</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <div class="ml-auto">
              <!--empty-->
            </div>
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="adminProfile.php">Manage Profile</a><a class="dropdown-item" href="#">About</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                          <div class="profile-img">
                            <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                              <div class="file btn btn-lg btn-primary">
                                  Upload Photo
                                  <input type="file" name="file"/>
                              </div>
                          </div>
                            <div class="sb-sidenav-menu-heading">Features</div>
                            <a class="nav-link" href="maintainMaterial.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                                Maintain Material Type</a
                            ><a class="nav-link" href="viewHistoryAdmin.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                                View Submission History</a
                            >
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION["username"];?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                      <h2 class="mt-4">View Submission History</h2>
                      <div class="card mb-4 mt-3">
                          <div class="card-header"><i class="fas fa-table mr-1"></i>Material List</div>
                          <div class="card-body">
                            <h5>Material</h5>
                            <select id="select_material" name="material" class="materialSelection p-1">
                              <
                              <option disabled selected value="">Select a material</option>
                              <?php
                              $sql_material = "SELECT * FROM material";
                              $result_material = $conn->query($sql_material);
                              if($result_material->num_rows>0){
                                while($row = $result_material->fetch_assoc()){
                                  echo '<option value='.$row["materialID"].'>'.$row["materialName"].'</option>';
                                }
                              }
                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="card mb-4 mt-3">
                          <div class="card-header"><i class="fas fa-table mr-1"></i>Submission Table</div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                          <tr>
                                              <th colspan=8><span id="totalWeight" class="ml-1 mr-5">Total Weight: 0</span><span id="totalPoints">Total Points: 0</span><button id="clearBtn" class="btn btn-primary squareBtn py-0 px-2 mr-2 float-right"><i class="fas fa-eraser"></i></button></th>
                                          </tr>
                                          <tr>
                                              <th>Submission ID</th>
                                              <th>Proposed Date</th>
                                              <th>Actual Date</th>
                                              <th>Collector</th>
                                              <th>Recycler</th>
                                              <th>Status</th>
                                              <th>Weight(kg)</th>
                                              <th>Points Awarded</th>
                                          </tr>
                                      </thead>
                                      <tbody id="submissionContent">

                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">© 2020 Copyright: OnePlanet</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">

        // To prevent the sort button set beside this element (select tag)
        setTimeout(function(){
          $('#dataTable thead').append(`<tr>
            <td><select class="w-100" name="submissionID" id="submissionID_select">
              <option selected value=""></option>
            </select></td>
            <td><select class="w-100" name="proposedDate" id="proposedDate_select">
              <option selected value=""></option>
            </select></td>
            <td><select class="w-100" name="actualDate" id="actualDate_select">
              <option selected value=""></option>
            </select></td>
            <td><select class="w-100" name="collector" id="collector_select">
              <option selected value=""></option>
            </select></td>
            <td><select class="w-100" name="recycler" id="recycler_select">
              <option selected value=""></option>
            </select></td>
            <td><select class="w-100" name="status" id="status_select">
              <option selected value=""></option>
            </select></td>
            <td><select class="w-100" name="weight" id="weight_select">
              <option selected value=""></option>
            </select></td>
            <td><select class="w-100" name="pointsAwarded" id="pointsAwarded_select">
              <option selected value=""></option>
            </select></td>
          </tr>`);
        }, 200);

        $("#select_material").change(function(){
          $.post("distinctSubmissionAdmin.php", {materialID: $(this).val()})
          .done(function(data){
            var distinct_submission_columns = JSON.parse(data);
            var distinct_submissionID = distinct_submission_columns[0];
            var distinct_proposedDate = distinct_submission_columns[1];
            var distinct_actualDate = distinct_submission_columns[2];
            var distinct_collector = distinct_submission_columns[3];
            var distinct_recycler = distinct_submission_columns[4];
            var distinct_status = distinct_submission_columns[5];
            var distinct_weight = distinct_submission_columns[6];
            var distinct_pointsAwarded = distinct_submission_columns[7];

            var dataExist = false;

            $.each(distinct_submission_columns, function(index, distinct_column){
              dataExist = true;
              var options='<option selected value=""></option>';
              $.each(distinct_column, function(index2, value){
                if(value!=null){
                  options += '<option value="'+value+'">'+value+'</option>';
                }
              });
              $("#dataTable thead").find("select")[index].innerHTML = options;
            });

            if(dataExist==true){
              dataExist=false;
            }else{
              $.each($("#dataTable thead").find("select"), function(index, selectTag){
                selectTag.innerHTML = '<option selected value=""></option>';
              });
            }
          });

          $.post("retrieveSubmissionAdmin.php", {materialID: $(this).val()})
          .done(function(data){
            if(data.length>0){
              var three_data = JSON.parse(data);
              var data_rows = three_data[0];
              var totalWeight = three_data[1];
              var totalPoints = three_data[2];

              var table = $("#submissionContent").parent().DataTable();

              table.rows().remove()

              for (var i = 0; i < data_rows.length; i++) {
                var row = data_rows[i];
                table.row.add([row["submissionID"], row["proposedDate"], row["actualDate"], row["collector"], row["recycler"], row["status"], row["weightInKg"], row["pointsAwarded"]]);
                table.draw();
              }
              // $("#submissionContent").html(rowsElement);
              $("#totalWeight").html("Total Weight: "+totalWeight);
              $("#totalPoints").html("Total Points: "+totalPoints);
            }else{
              var table = $("#submissionContent").parent().DataTable();
              table.rows().remove().draw();

            }
          });
        });

        $(document).on("change", "#dataTable thead tr td select", function(){
          var table = $("#submissionContent").parent().DataTable();
          var selectTags = $("#dataTable thead tr td select");
          var selectTags_id = [];
          $.each(selectTags, function(index, tag){
            selectTags_id.push(tag.id);
          });

          var i = $.inArray($(this).attr("id"), selectTags_id);

          if(table.column(i).search() !== $(this).val()){
            table
                .column(i)
                .search( $(this).val() )
                .draw();
          }
        });

        $(document).ready(function(){
          var table = $("#submissionContent").parent().DataTable();
          table.on('search.dt', function(){
            var totalWeight=0;
            var totalPoints=0;
            var data = table.rows({search: 'applied'}).data();
            $.each(data, function(index, value){
              totalWeight+=parseFloat(value[6]);
              totalPoints+=parseFloat(value[7]);
            });
            $("#totalWeight").html("Total Weight: "+totalWeight);
            $("#totalPoints").html("Total Points: "+totalPoints);
          });
        });

        $("#clearBtn").click(function(){
          var table = $("#submissionContent").parent().DataTable();

          var selectTags = $("#dataTable thead").find("select");
          $.each(selectTags, function(index, tag){
            tag.value = "";
            if(table.column(index).search() !== tag.value){
              table
                  .column(index)
                  .search( tag.value )
                  .draw();
            }
          });

          table.search("").draw();
        });
        </script>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js"></script>

    </body>
</html>
