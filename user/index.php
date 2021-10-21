<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
if(!isset($_SESSION["u_id"])) {
  header("Location: ../sign_in.php"); 
}
$msg="";
$u_id=$_SESSION["u_id"];
//$profilepicurl=$_SESSION["u_profilepic"];
$username=$_SESSION["u_name"];
$useremail=$_SESSION["u_email"];
require_once '../database/config.php';
$time_stamp = date('d/m/y H:i:s');
$mysqli = new mysqli($hn,$un,"",$db);
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{
  $reterive_legal_cat = "SELECT * FROM categories WHERE cat_parentcat='legal'";
  $result = $mysqli->query($reterive_legal_cat);
  $reterive_marketing_cat = "SELECT * FROM categories WHERE cat_parentcat='marketing'";
  $result1 = $mysqli->query($reterive_marketing_cat);
}
if (isset($_POST['view_legal'])) {
  if (isset($_POST['legal'])) {
    $selectd_cat=$_POST['legal'];
    $arr = explode('|', $selectd_cat);
    $cat_id=$arr[0];
    $cat_name=$arr[1];
    $_SESSION["cat_id"]=$cat_id;
    $_SESSION["cat_name"]=$cat_name;
    header("Location: pages/view_legal_contracts.php"); 
 }
}
if (isset($_POST['view_marketing'])) {
  if (isset($_POST['marketing'])) {
    $selectd_cat=$_POST['marketing'];
    $arr = explode('|', $selectd_cat);
    $cat_id=$arr[0];
    $cat_name=$arr[1];
    $_SESSION["cat_id"]=$cat_id;
    $_SESSION["cat_name"]=$cat_name;
    header("Location: pages/view_marekting_assests.php"); 
 }
}
if(isset($_POST['upload']))
{
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];    
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  $final_file_name=$u_id.".".$extension;
  $folder = "profilepic/".$u_id;
     $sql = "UPDATE users SET u_profilepic='$u_id' WHERE u_id='$u_id'";
      mysqli_query($mysqli, $sql);
     if (move_uploaded_file($tempname, $folder))  {
      $showModalSuccessful="true";
      $msg="Profile Picture Updated Successfully.";
      }else{
        $showModalFailed="true";
        $msg="Failed to Update Profie Picture.";
    }
}
if (isset($_POST['update_profile'])) {
  $username = $_POST["username"];
  $useremail = $_POST["useremail"]; 

  $update_sql = "UPDATE users SET u_name='$username', u_email='$useremail' WHERE u_id='$u_id'";
  if ($mysqli->query($update_sql) === TRUE) {
    $showModalSuccessful="true";
    $msg="Profile Updated Successfully.";
    $_SESSION["u_name"]=$username;
    $_SESSION["u_email"]=$useremail;
  } else {
    $msg="Failed to Update Profie.";
    $showModalFailed="true";
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
  <link href="img/logo/logo.png" rel="icon">
  <title>The Counsel Suite</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <!-- Select2 -->
   <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="css/custom_css.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">Counsel Suite</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Documents
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>My Favorites</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Bootstrap UI</h6> -->
            <a class="collapse-item" href="Pages/view_legal_favorites.php">Legal Contracts</a>
            <a class="collapse-item" href="Pages/view_marketing_favorites.php">Marketing Assets</a>
          </div>
        </div>
        </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Help
      </div>
      <li class="nav-item">
        <a class="nav-link " href="Pages/contact_us.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Contact Us</span>
        </a>
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
                <img class="img-profile rounded-circle" src="<?php echo "profilepic/".$u_id;?>" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $username;?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#profileModal">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#changepassword">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Change Password
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

         <!--custom code-->
         <div class="row">
          <div class="col-lg-6">
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold " style="color:#3f51b5;" >Legal Contarcts</h5>
              </div>
              <div class="card-body">
                <center><button class="btn1 success1"><i class="fa fa-university fa-3x"></i></button></center>
                <form method="POST">
                <h6 class=" font-weight-bold "style="margin: bottom 200px; color:#3f51b5; ">Select Act</h6>   
                <select style="padding-top: .4rem;" class="select2-single form-control" name="legal" id="select2Single"required>
                <option value="">--Select--</option>
                  <?php
                      if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo '<option value="'.$row["cat_id"]."|".$row["cat_name"].'">'.$row["cat_name"].'</option>';
                          //echo "<option value=".$row['cat_id']."|".$row['cat_name'].">".$row['cat_name']."</option>";
                          // echo "id: " . $row["cat_id"]. " - Name: " . $row["cat_name"]. " " . $row["cat_parentcat"]. "<br>";
                        }
                      } else {
                        echo '<option value="">Not Found</option>';
                      } 
                    ?>
                </select>      
                <a href="Pages/view_legal_contracts.php"> <button type="submit" name="view_legal" style="margin-top: .5rem; float: right;" class="btn btn-primary">Submit</button></a>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold "style="color:#3f51b5;">Marketing Assests</h5>
              </div>
              <div class="card-body">
                <center><button class="btn1 success1"><i class="fa fa-bullhorn fa-3x"></i></button></center>
                <h6 class=" font-weight-bold "style="margin: bottom 200px; color:#3f51b5; ">Select Assets</h6>   
                <form method="POST">
                <select style="padding-top: .4rem;" class="select2-single form-control" name="marketing" id="select2Single1" required>
                <option value="">--Select--</option>
                  <?php
                      if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result1->fetch_assoc()) {
                          echo '<option value="'.$row["cat_id"]."|".$row["cat_name"].'">'.$row["cat_name"].'</option>';
                          //echo "<option value=".$row['cat_id']."|".$row['cat_name'].">".$row['cat_name']."</option>";
                          // echo "id: " . $row["cat_id"]. " - Name: " . $row["cat_name"]. " " . $row["cat_parentcat"]. "<br>";
                        }
                      } else {
                        echo '<option value="">Not Found</option>';
                      } 
                    ?>
                </select>  
             <a href="Pages/view_marekting_assests.php">   <button  type="submit" name="view_marketing" style="margin-top: .5rem; float: right;" class="btn btn-primary">Submit</button> </a>
                </form>
              </div>
            </div>
          </div>
        </div>
          <!--End-->

          
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
                  <img src="<?php echo "profilepic/".$u_id;?>" class="rounded-circle mx-auto d-block" alt="100x100" style="width: 5rem;" accept="image/*">
                  <input type="file" style="margin-top: 1rem; padding-left: 8rem; "accept="image/x-png,image/jpeg" name="uploadfile" required/>
                  <button input type="submit" name="upload" class="btn btn-primary" style="margin-top: 1rem;">Upload</button>
                  <hr>
                  </center>
                </form>
                  <h6 class="m-0 font-weight-bold" style="padding-bottom: 1rem;" >Personal Info</h6>
                  <form method="post">
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Name</label>
                      <input type="text" class="form-control" name="username"
                        placeholder="Enter Name" value="<?php echo $username; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Email</label>
                      <input type="email" class="form-control" name="useremail"
                        placeholder="Enter Email" value="<?php echo $useremail; ?>" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                          <button name="update_profile" input type="submit" class="btn btn-primary">Update</button>
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
      
       <!-- Modal Profile -->
       <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Change Password </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post">
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Old Password</label>
                      <input type="password" class="form-control" name="username"
                        placeholder="Enter Old Password" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">New Password</label>
                      <input type="password" class="form-control" name="useremail"
                        placeholder="Enter New Password" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                          <button name="change_pass" input type="submit" class="btn btn-primary">Change Password</button>
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
            <p><?php echo $msg;?></p>
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
            <p><?php echo $msg ?></p>
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
                  <a href="login.php" class="btn btn-primary">Logout</a>
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
              <b><a href="$" target="_blank">Counsel Suite</a></b>
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
  
  
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
  <!-- Select2 -->
  <script src="vendor/select2/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function () {


      $('.select2-single').select2();

      
     
    });
  </script>
  <?php			
  if(!empty($showModalSuccessful)) {
    // CALL MODAL HERE
    echo '<script type="text/javascript">
      $(document).ready(function(){
        $("#popupModalSuccessful").modal("show");
      });
    </script>';
  } 
  if(!empty($showModalFailed)) {
    // CALL MODAL HERE
    echo '<script type="text/javascript">
      $(document).ready(function(){
        $("#popupModalFailed").modal("show");
      });
    </script>';
  } 
  ?>
</body>

</html>