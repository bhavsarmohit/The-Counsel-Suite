<?php
session_start();
if(!isset($_SESSION["u_id"])) {
  header("Location: ../../sign_in.php"); 
}
$msg="";
$u_id=$_SESSION["u_id"];
//$profilepicurl=$_SESSION["u_profilepic"];
$username=$_SESSION["u_name"];
$useremail=$_SESSION["u_email"];
$userid=$_SESSION["u_id"];
require_once '../../database/config.php';
$time_stamp = date('d/m/y H:i:s');
$mysqli = new mysqli($hn,$un,"",$db);
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{ 
  if(isset($_POST['submit']))
{
  $fname=$_SESSION['u_name'];
  $femail=$_SESSION['u_email'];
  $fmobno=$_POST['mobno'];
  $msg=$_POST['msg'];
  $add_contact="INSERT INTO `contactus_data`(`id`,`userid`, `name`, `email`, `mobno`, `msg`, `timestamp`) VALUES (NULL,'$userid','$fname','$femail','$fmobno','$msg','$time_stamp')";
  //$add_contact="INSERT INTO contactus_data (userid,name,email,mobno.msg,timestamp) VALUES('$userid','$fname','$femail','$fmobno','$msg','$time_stamp')";
  if ($mysqli->query($add_contact) === TRUE) {
    $showModalSuccessful="true";
  } else {
    //echo "Error: " . $add_contact . "<br>" . $mysqli->error;
    $showModalFailed="true";
  }
}
}

if(isset($_POST['upload']))
{
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];    
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  $final_file_name=$u_id.".".$extension;
  $folder = "../profilepic/".$u_id;
     $sql = "UPDATE users SET u_profilepic='$u_id' WHERE u_id='$u_id'";
      mysqli_query($mysqli, $sql);
     if (move_uploaded_file($tempname, $folder))  {
      $msg="Profile Picture Updated Successfully.";
      $showModalSuccessful="true";
      
      }else{
        $msg="Failed to Update Profie Picture.";
        $showModalFailed="true";
      
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
if (isset($_POST['change_pass'])) {
  $cur_pass="";
  $sql = "SELECT * FROM users";
  $result = $mysqli->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $cur_pass=  $row["u_pass"];
  }
  $oldPass=$_POST["oldpass"];
  $newPass=$_POST["newpass"];
  if($cur_pass==md5($oldPass))
  {
    $newPass=md5($newPass);
    $update_sql = "UPDATE users SET u_pass='$newPass' WHERE u_id='$u_id'";
    if ($mysqli->query($update_sql) === TRUE) {
      $showModalSuccessful="true";
      $msg="Password Changed Successfully.";
    } else {
      $msg="Failed to Chanage Password.";
      $showModalFailed="true";
    }
  }
  else{
    $msg="Please enter valid current password.";
    $showModalFailed="true";
  }
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
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.html">
        <div class="sidebar-brand-icon">
          <img src="../img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">Counsel Suite</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="../index.html">
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
            <a class="collapse-item" href="view_legal_favorites.php">Legal Contracts</a>
            <a class="collapse-item" href="view_marketing_favorites.php">Marketing Assets</a>
          </div>
        </div>
        </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Help
      </div>
      <li class="nav-item">
        <a class="nav-link " href="contact_us.html">
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
                <img class="img-profile rounded-circle" src="<?php if(file_exists("../profilepic/".$u_id)){echo "../profilepic/".$u_id;}else{echo "../profilepic/boy.png";} ?>" style="max-width: 60px">
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
            <h1 class="h3 mb-0 text-gray-800">Contact Us</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
          </div>

          <div class="card">
            <!-- write your code here -->
            <!-- General Element -->
            <!-- <div class="card mb-4"> -->
              <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"> -->
                <!-- <h6 class="m-0 font-weight-bold text-primary">General Element</h6> -->
              <!-- </div> -->
              <div class="card-body">
                <form method="post">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Name</label>
                    <input class="form-control mb-3" type="text" placeholder="Your Name"id="name" name="name1" value="<?php echo $_SESSION["u_name"];?>" disabled required>

                    <label for="exampleFormControlInput1 mb-3">Email address</label>
                    <input type="email" class="form-control mb-3" id="email" placeholder="name@example.com" name="email" value="<?php echo $_SESSION["u_email"];?>" disabled required>
                    
                    <label for="exampleFormControlInput1">Mobile No.</label>
                    <input class="form-control mb-3" type="number" name="mobno" required>

                    <label for="exampleFormControlTextarea1">Message</label>
                    <textarea class="form-control mb-3" id="exampleFormControlTextarea1" rows="3" placeholder="Write your message here..." name="msg" required></textarea>
                    
                    
                    <button  type="submit" name="submit" class="btn btn-primary">Submit</button>
                    
                  </div>
                  
                  
                </form>
              </div>
            <!-- </div> -->
            
            
          </div>
          <!--Row-->

          
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
            <p>Thanks for contacting.</p>
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
            <p>Failed to submit. Try Again.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
          </div>
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
                  <img src="<?php if(file_exists("../profilepic/".$u_id)){echo "../profilepic/".$u_id;}else{echo "../profilepic/boy.png";} ?>" class="rounded-circle mx-auto d-block" alt="100x100" style="width: 5rem;" accept="image/*">
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
      
       <!-- Modal password -->
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
                      <label for="exampleFormControlInput1">Current Password</label>
                      <input type="password" class="form-control" name="oldpass"
                        placeholder="Enter Old Password" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">New Password</label>
                      <input type="password" class="form-control" name="newpass"
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
                  <a href="../logout.php" class="btn btn-primary">Logout</a>
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
              <b><a href="#" target="_blank">Counsel Suite</a></b>
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