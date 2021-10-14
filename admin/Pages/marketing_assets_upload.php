<?php 
session_start();
$adminid=$_SESSION['id'];
require_once '../../database/config.php';
$date = date('Y/m/d H:i:s');
$mysqli = new mysqli($hn,$un,"",$db);
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{  
  //load classes
  
  $sql = "SELECT * FROM categories";
  $result = $mysqli->query($sql);
  
}


$mysqli = new mysqli($hn,$un,"",$db);
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

if(isset($_POST['submit']))
{
  // echo "button click";
  $nameAsset=$_POST['nameAsset'];
  $desc=$_POST['desc'];
  $category=$_POST['category'];
  $docPath=$_POST['filePath'];

  $sql = "INSERT INTO `marketing_assets` (`c_id`, `c_name`, `c_description`, `c_category`, `c_parentcat`, `c_file`, `c_timestamp`, `c_adminid`) VALUES (NULL, '$nameAsset', '$desc', '$category', 'marketing', '$docPath', '$date', '$adminid');";

  if ($mysqli->query($sql) === TRUE) {
    // echo "New record created successfully";

    $showModalSuccessful = "true";



  } else {
    // echo "Error: " . $sql . "<br>" . $conn->error;
    $showModalFailed = "true";
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
  <link href="..img/logo/logo.png" rel="icon">
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
            <a class="collapse-item" href="add_category.html">Add</a>
            <a class="collapse-item" href="view_category.html">View</a>
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
            <a class="collapse-item" href="legal_contracts_upload.html">Add</a>
            <a class="collapse-item" href="legal_contracts_view.html">View</a>
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
            <a class="collapse-item" href="marketing_assets_upload.html">Add</a>
            <a class="collapse-item" href="marketing_assets_view.html">View</a>
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
                <img class="img-profile rounded-circle" src="../img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">Maman Ketoprak</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
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
            <h1 class="h3 mb-0 text-gray-800">Add Marketing Assets</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Marketing Assests</li>
            </ol>
          </div>

          
            <!-- write your code here -->
            <div class="card mb-3">
                
              <div class="card-body">
                <form method="post">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Name of Assets</label>
                    <input type="text" class="form-control" id="nameAsset" name="nameAsset" required
                      placeholder="Enter Name of Contract">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Description</label>
                    <input type="text" class="form-control" id="desc" name="desc" required
                      placeholder="Enter Contract Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Category</label>
                    <select class="form-control" id="category" name="category" required>
                    <option value="">--SELECT CATEGORY--</option>
                    <?php
                      if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo "<option value=".$row['cat_name'].">".$row['cat_name']."</option>";
                          // echo "id: " . $row["cat_id"]. " - Name: " . $row["cat_name"]. " " . $row["cat_parentcat"]. "<br>";
                        }
                      } else {
                        echo "0 results";
                      } 
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Document</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="filePath" name="filePath" required>
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-10">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Publish</button>
                      </div>
                    </div>
                  
                    
                  </div>
                </form>
              </div>
            </div>
          </div>
       
            
            
          
          <!--Row-->

          <!-- Modal popup Successful -->
          <div class="modal fade" id="popupModalSuccessful" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelPopout"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelPopout">Congratulations!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
          <p>Successfully Published!</p>
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
          <h5 class="modal-title" id="exampleModalLabelPopout">Oops. Something went wrong!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
          <p>There was an error with your request!</p>
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
                  <a href="login.html" class="btn btn-primary">Logout</a>
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