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
        <title>Maintain Material Type - Admin</title>
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
                      <h2 class="mt-4">Maintain Material Type</h2>
                      <div class="card mb-4 mt-3">
                          <div class="card-header"><i class="fas fa-table mr-1"></i>Material Table <button class="btn btn-success squareBtn py-0 px-2 float-right" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button></div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                          <tr>
                                              <th>Material ID</th>
                                              <th>Material Name</th>
                                              <th>Description</th>
                                              <th>Points(per kg)</th>
                                              <th>Options</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $sql_Materials = "SELECT * FROM material WHERE materialStatus='Available'";
                                          $results = $conn->query($sql_Materials);
                                          if($results->num_rows > 0){
                                            while($row = $results->fetch_assoc()){
                                              echo '<tr>
                                                        <td>'.$row["materialID"].'</td>
                                                        <td>'.$row["materialName"].'</td>
                                                        <td>'.$row["description"].'</td>
                                                        <td>'.$row["pointsPerKg"].'</td>
                                                        <td class="buttonGroup text-center">
                                                          <button onclick="editButton(this)" class="editBtn btn btn-info squareBtn py-0 px-2"><i class="fas fa-cog"></i></button>
                                                          <button onclick="confirmButton(this)" class="confirmBtn btn btn-primary squareBtn py-0 px-2 margin-r d-none"><i class="fas fa-save"></i></button>
                                                          <button onclick="deleteButton(this)" class="deleteBtn btn btn-danger squareBtn py-0 px-2 margin-r d-none"><i class="fas fa-trash-alt"></i></button>
                                                          <button onclick="cancelButton(this)" class="cancelBtn btn btn-warning squareBtn text-light py-0 px-2 d-none"><i class="fas fa-times"></i></button>
                                                        </td>
                                                    </tr>';
                                            }
                                          }
                                        ?>
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

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js"></script>

    </body>
</html>
