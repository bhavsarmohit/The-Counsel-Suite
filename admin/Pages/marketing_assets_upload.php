<?php 
session_start();
$adminid=$_SESSION['id'];
$a_id=$_SESSION['id'];
$admin_name=$_SESSION["adminname"];
$a_email=$_SESSION["adminemail"];
require_once '../../database/config.php';
$date = date('Y/m/d H:i:s');
$mysqli = new mysqli($hn,$un,"",$db);
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{  
  $sql = "SELECT * FROM categories WHERE cat_parentcat='marketing'";
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
        $msg="Profile Picture Updated Successfully.";
          $showModalSuccessful = "true";
      }else{
        $msg="Failed to update Profile Picture.";
        $showModalFailed = "true";
    }
}
if (isset($_POST['update'])) {
  $admin_name = $_POST["admin_name"];
  $admin_email = $_POST["admin_email"];    
  $update_sql = "UPDATE admin SET name='$admin_name', email='$admin_email' WHERE id='$a_id'";
  if ($mysqli->query($update_sql) === TRUE) {
    $msg="Profile Updated Sucessfully.";
    $showModalSuccessful = "true";
    $_SESSION["adminname"]=$admin_name;
    $_SESSION["adminemail"]=$admin_email;
  } else {
    $msg="Failed to update profile.";
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
  <link href="../img/logo/logo.png" rel="icon">
  <title>The Counsel Suite</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    function showname () {
      var name = document.getElementById('fileInput'); 
      var filename=name.files.item(0).name.split(".", 1);
      document.cookie='filenamecookie='+name.files.item(0).name; 
      document.getElementById("name_contract").value =filename;
    };
    </script>
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
                <a class="dropdown-item"data-toggle="modal" data-target="#profileModal">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
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
              <li class="breadcrumb-item active" aria-current="page">Add Marketing Assets</li>
            </ol>
          </div>

         
            <!-- write your code here -->
            
            <div class="card mb-3">
              <div class="card-body">
                <form id="uploadForm"  enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Select Document</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="fileInput" name="file"  onchange="showname()" accept=".doc,.docx" required>
                    <label class="custom-file-label" for="fileInput">Choose file</label>
                  </div>
                </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Name of Asset</label>
                    <input type="text" class="form-control" id="name_contract" name="name_contract"
                      placeholder="Enter Name of Asset"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Description</label>
                    <input type="text" class="form-control" id="desc" name="desc"
                      placeholder="Enter Asset Description" >
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Category</label>
                    <select class="form-control" id="category" name="category" >  
                    <option value="">--SELECT CATEGORY--</option>
                    <?php
                      if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo '<option value="'.$row["cat_id"]."|".$row["cat_name"].'">'.$row["cat_name"].'</option>';
                          //echo "<option value=".$row['cat_id']."|".$row['cat_name'].">".$row['cat_name']."</option>";
                          // echo "id: " . $row["cat_id"]. " - Name: " . $row["cat_name"]. " " . $row["cat_parentcat"]. "<br>";
                        }
                      } 
                    ?>
                    </select>
          
                  </div>
                  
                  <div class="form-group row">
                      <div class="col-sm-10">
                        <button name="submit" type="submit" class="btn btn-primary">Publish</button>
                      </div>
                    </div>
                    <div class="progress" style="margin-top: 1rem;" >
                    <div class="progress-bar" role="progressbar" style="width:0%;" aria-valuenow="0"
                      aria-valuemin="0" aria-valuemax="100">0%</div>
                  </div>
                  <div id="uploadStatus"></div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <script>
      $('#fileInput').on('change',function(){
          //get the file name
          var fileName = $(this).val();
          //replace the "Choose a file" label
          $(this).next('.custom-file-label').html(fileName);
      })
  </script>
          <script>
$(document).ready(function(){
    // File upload via Ajax
    $("#uploadForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'upload_marketing.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp){
                if(resp == 'ok'){
                    $('#uploadForm')[0].reset();
                    $('#uploadStatus').html('<p style="color:#28A74B;">Contract Published Successfully.</p>');
                   
                }else if(resp == 'err'){
                  $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                }
              else if(resp == 'already'){
                $(".progress-bar").width('0%');
                 $(".progress-bar").html('0%');
                    $('#uploadStatus').html('<p style="color:#EA4335;">File Already Exists.</p>');
                }
                else if(resp == 'already_cat'){
                $(".progress-bar").width('0%');
                 $(".progress-bar").html('0%');
                    $('#uploadStatus').html('<p style="color:#EA4335;">Contract Already Exists.</p>');
                }
            }
        });
    });
	
    // File type validation
    $("#fileInput").change(function(){
        var allowedTypes = ['application/msword','application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        var file = this.files[0];
        var fileType = file.type;
        if(!allowedTypes.includes(fileType)){
            alert('Please select a valid file (DOC/DOCX).');
            $("#fileInput").val('');
            return false;
        }
    });
});
</script>
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
                          <button name="update" input type="submit" class="btn btn-primary">Update</button>
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
            <h5 class="modal-title" id="exampleModalLabelPopout">Congratulations!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p><?php echo$msg; ?></p>
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
            <p><?php echo$msg; ?></p>
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