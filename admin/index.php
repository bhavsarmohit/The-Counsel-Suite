<?php
session_start();
require_once '../database/config.php';
if (isset($_POST['submit']))
{
  $mysqli = new mysqli($hn,$un,$pw,$db);
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{
  $email=$_POST['email'];
  $pass=$_POST['pass'];
  //$pass=md5($pass);
  $check_credentials="select * from admin where email='$email' and password='$pass'";
  $raw=mysqli_query($mysqli,$check_credentials);
  $count=mysqli_num_rows($raw);
  if($count>0)
  {
    $row=mysqli_fetch_array($raw);
    $a_id = $row[0];
    $a_name = $row[1];
    $a_email = $row[2];
    $a_profilepic = $row[6];
    $_SESSION["id"] = $a_id;
    $_SESSION["adminname"] = $a_name;
    $_SESSION["adminemail"] = $a_email;
    $_SESSION["adminprofilepic"] = $a_profilepic;
    header("Location: dashboard.php"); 
  }
  else
  {
    echo "not found";
  } 
}
}

if(isset($_SESSION["adminname"])) {
  header("Location:dashboard.php");
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
  <title>Counsel Suite Admin - Login</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                        placeholder="Enter Email Address" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                    <button  name="submit" input type="submit"class="btn btn-primary btn-block">Login</button>
                    </div>
                  </form> 
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>
</html>