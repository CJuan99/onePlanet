<?php
session_start();
include("maintainMaterial_JS.php");
$username_session = $_SESSION["username"];
$sql_user = "SELECT * FROM users WHERE username='$username_session'";
$result_user = $conn->query($sql_user);

if($result_user->num_rows > 0){
  $row_user = $result_user->fetch_assoc();

  $username = $row_user["username"];
  $password = $row_user["password"];
  $fullname = $row_user["fullname"];
}
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
                            ><a class="nav-link" href="viewHistory.php"
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
                      <h2 class="mt-4">Manage Profile</h2>
                      <div class="card mb-4 mt-3">
                          <div class="card-header"><i class="fas fa-user-alt"></i> Profile Information
                            <button onclick="editProfile(this)" id="editProfileBtn" class=" btn btn-info squareBtn py-0 px-2 float-right"><i class="fas fa-cog"></i></button>
                            <button onclick="cancelProfile(this)" id="cancelProfileBtn" class="btn btn-warning squareBtn text-light py-0 px-2 float-right d-none"><i class="fas fa-times"></i></button>
                            <button onclick="confirmProfile(this)" id="confirmProfileBtn" class="btn btn-primary squareBtn py-0 px-2 mr-3 float-right d-none"><i class="fas fa-save"></i></button>
                          </div>
                          <div class="card-body">
                            <form name="profileForm" action="javascript:void(0)" method="POST" onsubmit="checkFormSubmitted()">
                              <div class="form-group">
                                <label class="mb-2">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username;?>" required readonly>
                              </div>
                              <div class="form-group">
                                <label class="mb-2">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="" value="******" minlength="6" readonly>
                              </div>
                              <div class="form-group">
                                <label class="mb-2">Fullname</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Fullname" value="<?php echo $fullname;?>" required minlength="5" pattern="[A-Za-z ]{5,}" title="Fullname must be all alphabets with at least 5 characters" readonly>
                              </div>
                              <input class="d-none" type="submit" id="submit">
                            </form>
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

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js"></script>

    </body>
</html>
