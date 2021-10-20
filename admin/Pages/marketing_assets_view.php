<?php
error_reporting(0);
session_start();
require_once '../../database/config.php';
if(isset($_SESSION["adminname"])) {
  $admin_name=$_SESSION["adminname"];
  $pic_url=$_SESSION["adminprofilepic"];
  $a_email=$_SESSION["adminemail"];
  $a_id=$_SESSION["id"];
}
else
{
  header("Location:../index.php");
}
$mysqli = new mysqli($hn,$un,"",$db);
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{
  $sql = "SELECT * FROM marketing_assests";
  $result = $mysqli->query($sql);
  
}
if (isset($_POST['upload'])) {
  
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];    
      $folder = "../img/profile_pic/".$a_id;

      // Get all the submitted data from the form
      $sql = "UPDATE admin SET profile_pic='$a_id' WHERE id='$a_id'";

      // Execute query
      mysqli_query($mysqli, $sql);
        
      // Now let's move the uploaded image into the folder: image
      if (move_uploaded_file($tempname, $folder))  {
          $showProfilepicupdateModalSuccessful = "true";
      }else{
        $showProfilepicupdateModalFailed = "true";
    }
}
if (isset($_POST['submit'])) {
  $admin_name = $_POST["admin_name"];
  $admin_email = $_POST["admin_email"];    
  $update_sql = "UPDATE admin SET name='$admin_name', email='$admin_email' WHERE id='$a_id'";
  if ($mysqli->query($update_sql) === TRUE) {
    $showProfileupdateModalSuccessful = "true";
    $_SESSION["adminname"]=$admin_name;
    $_SESSION["adminemail"]=$admin_email;
  } else {
    $showProfileupdateModalFailed = "true";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="../img/logo/logo.png" rel="icon">
  <title>The Counsel Suite</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
        <div class="sidebar-brand-icon">
          <img src="../img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">Counsel Suite</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Categories
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Category</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Bootstrap UI</h6> -->
            <a class="collapse-item" href="add_category.php">Add</a>
            <a class="collapse-item" href="view_category.php">View</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Documents
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Legal Contracts</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Bootstrap UI</h6> -->
            <a class="collapse-item" href="legal_contracts_upload.php">Add</a>
            <a class="collapse-item" href="legal_contracts_view.php">View</a>
          </div>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
          aria-controls="collapseForm">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Marketing Assets</span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Forms</h6> -->
            <a class="collapse-item" href="marketing_assets_upload.php">Add</a>
            <a class="collapse-item" href="marketing_assets_view.php">View</a>
          </div>
        </div>
      </li>
      
      <hr class="sidebar-divider">
      
      
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="<?php echo "../img/profile_pic/".$a_id;?>" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $admin_name;?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#profileModal">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Marketing Asset List</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Marketing Asset List</li>
            </ol>
          </div>

          
            <!-- write your code here -->
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Name of Asset</th>
                        <th>Description</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>".$row['c_id']."</td>";
                          echo "<td>".$row['c_name']."</td>";
                          echo "<td>".$row['c_description']."</td>";
                          echo "<td>";
                          echo '<a href="edit_marketing_asset.php?id='.$row["c_id"].'"><i class="fa fa-pencil"style="color: blue;" aria-hidden="true"></i></a>';
                          echo '<a href="delete_marketing_asset.php?id='.$row["c_id"].'"><i class="fa fa-trash-o" style="color: blue; padding-left: 1rem;" aria-hidden="true"></i></a>';
                          echo "</td>";
                          echo "</tr>";
                        }
                      } else {
                        // echo "No Records Found.";
                      }            
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
            
          
          <!--Row-->

           <!-- Modal Profile -->
           <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Profile</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <h6 class="m-0 font-weight-bold">Profile Picture</h6>
                <form method="post" action="" enctype="multipart/form-data">
                  <center>
                  <img src="<?php echo "../img/profile_pic/".$a_id;?>" class="rounded-circle mx-auto d-block" alt="100x100" style="width: 5rem;">
                  <input type="file" style="margin-top: 1rem; padding-left: 8rem; "accept="image/x-png,image/jpeg" name="uploadfile" required/>
                  <button input type="submit" name="upload" class="btn btn-primary" style="margin-top: 1rem;">Upload</button>
                  <hr>
                  </center>
                </form>
                  <h6 class="m-0 font-weight-bold" style="padding-bottom: 1rem;" >Personal Info</h6>
                  <form method="post">
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Name</label>
                      <input type="text" class="form-control" name="admin_name"
                        placeholder="Enter Name" value="<?php echo $admin_name; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Email</label>
                      <input type="email" class="form-control" name="admin_email"
                        placeholder="Enter Email" value="<?php echo $a_email; ?>" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                          <button name="submit" input type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal popup Successful -->
          <div class="modal fade" id="popupModalSuccessful" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelPopout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelPopout">Sucesss</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>Profile Updated Sucessfully.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
          </div>

          <!-- Modal popup Failed -->
          <div class="modal fade" id="popupModalFailed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelPopout"
          aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelPopout">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>Failed to update profile. Try Again.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
          </div>

          <!-- Modal profile pic Successful -->
          <div class="modal fade" id="popuppicModalSuccessful" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelPopout"
          aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelPopout">Sucesss</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>Profile Picture Sucessfully.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
          </div>

          <!-- Modal profilepic Failed -->
          <div class="modal fade" id="popuppicModalFailed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelPopout"
          aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelPopout">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>Failed to update profile picture. Try Again.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
          </div>


          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="../../logout.php" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="#" target="_blank">The Counsel Suite</a></b>
            </span>
          </div>
        </div>


      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>  
  <?php			
    if(!empty($showProfileupdateModalSuccessful)) {
      // CALL MODAL HERE
      echo '<script type="text/javascript">
        $(document).ready(function(){
          $("#popupModalSuccessful").modal("show");
        });
      </script>';
    } 
    if(!empty($showProfileupdateModalFailed)) {
      // CALL MODAL HERE
      echo '<script type="text/javascript">
        $(document).ready(function(){
          $("#popupModalFailed").modal("show");
        });
      </script>';
    } 
    if(!empty($showProfilepicupdateModalSuccessful)) {
      // CALL MODAL HERE
      echo '<script type="text/javascript">
        $(document).ready(function(){
          $("#popuppicModalSuccessful").modal("show");
        });
      </script>';
    } 
    if(!empty($showProfilepicupdateModalFailed)) {
      // CALL MODAL HERE
      echo '<script type="text/javascript">
        $(document).ready(function(){
          $("#popuppicModalFailed").modal("show");
        });
      </script>';
    } 
  ?>

</body>

</html>