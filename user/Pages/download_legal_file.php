<?php
session_start();
$date=date("d/m/Y");
$filepath="sam";
if(!isset($_SESSION["u_id"])) {
  header("Location: ../../sign_in.php"); 
}
if(isset($_GET['id'])) {
  $reterived_catid=$_GET['id'];  
 }
 else
 {
  header("Location: ../../sign_in.php"); 
 }
require_once '../../database/config.php';
$time_stamp = date('d/m/y H:i:s');
$mysqli = new mysqli($hn,$un,"",$db);
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{ 
  
$sql = "SELECT * FROM  legal_contracts WHERE c_id='$reterived_catid'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
     $filepath="../../documents/legal/".$row["c_file"];
  }
} 
$reterive_total_count = "SELECT * FROM total_downloads WHERE date='$date'";
$result1 = $mysqli->query($reterive_total_count);
if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
     $total_download_count=$row["downloads"];
     $total_download_count=$total_download_count+1;
     $update_count="UPDATE total_downloads SET downloads='$total_download_count' WHERE date='$date'";
     $mysqli->query($update_count);
  }
 
} 
else
{
  $insert_total_downloads="INSERT INTO total_downloads(date,downloads)VALUES('$date','1')";
  $mysqli->query($insert_total_downloads);
}


$reterive_legal_count = "SELECT * FROM legal_downloads WHERE date='$date'";
$result2 = $mysqli->query($reterive_legal_count);
if ($result2->num_rows > 0) {
  // output data of each row
  while($row = $result2->fetch_assoc()) {
     $total_download_count=$row["downloads"];
     $total_download_count=$total_download_count+1;
     $update_count="UPDATE legal_downloads SET downloads='$total_download_count' WHERE date='$date'";
     $mysqli->query($update_count);
  }
 
} 
else
{
  $insert_total_downloads="INSERT INTO legal_downloads(date,downloads)VALUES('$date','1')";
  $mysqli->query($insert_total_downloads);
}
}
//echo $filepath;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/e48d166edc.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">
  <title>Downloading File...</title>

</head>
<body>
  <div class="download-container">
    <a href="#" class="download-btn"> <i class="fas fa-cloud-download-alt "></i> Download Now</a>
    <div class="countdown"></div>
    <div class="pleaseWait-text">Please Wait...</div>
    <div class="manualDownload-text">Direct Link <a href="" class="manualDownload-link">click here.</a></div>
    <label style="cursor:pointer;" onclick="goback()">Go Back</label>
  </div>
<script>
  function goback()
  {
    window.location.replace('view_legal_contracts.php');
  }
  </script>
<script type="text/javascript">
  const downloadBtn = document.querySelector(".download-btn");
  const countdown = document.querySelector(".countdown");
  const pleaseWaitText = document.querySelector(".pleaseWait-text");
  const manualDownloadText = document.querySelector(".manualDownload-text");
  const manualDownloadLink = document.querySelector(".manualDownload-link");
  var timeLeft = 10;
  
downloadBtn.addEventListener("click", () => {
    downloadBtn.style.display = "none";
    countdown.innerHTML = "Your download will start in <span>" + timeLeft + "</span> seconds."  //for quick start of countdown

    var downloadTimer = setInterval(function timeCount() {
      timeLeft -= 1;
      countdown.innerHTML = "Your download will start in <span>" + timeLeft + "</span> seconds.";

      if(timeLeft <= 0){
        clearInterval(downloadTimer);
        pleaseWaitText.style.display = "block";
        var download_href = "<?php echo $filepath;?>"; //enter the downlodable file link here
        window.location.href = download_href;
        manualDownloadLink.href = download_href;
        setTimeout(() => {
          pleaseWaitText.style.display = "none";
        manualDownloadText.style.display = "block"
        }, 4000);
      }
      
    }, 1000);
    
  });
  
  </script>

</body>
</html>
