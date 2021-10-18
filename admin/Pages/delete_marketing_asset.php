<?php
error_reporting(0);
session_start();
require_once '../../database/config.php';
if(isset($_SESSION["adminname"])) {
  $admin_name=$_SESSION["adminname"];
  $pic_url=$_SESSION["adminprofilepic"];
  if(isset($_GET['id'])) {
    $reterived_catid=$_GET['id'];  
    }
  else
  {
    header("Location: marketing_assets_view.php");
  }
  
 
}
else
{
  header("Location:../index.php");
}
$mysqli = new mysqli($hn,$un,"",$db);

if ($mysqli -> connect_errno) {
    header("Location: marketing_assets_view.phpp");
  exit();
}
else
{
    $sql = "SELECT * FROM marketing_assests WHERE c_id=$reterived_catid";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       // echo "c_file: " . $row["c_file"];
        $file_pointer = "../../documents/marketing/".$row["c_file"]; 
        if (!unlink($file_pointer)) { 
            header("Location: marketing_assets_view.php");
        } 
        else { 
            $del_catdata="DELETE FROM `marketing_assests` WHERE `c_id`=$reterived_catid";
            if ($mysqli->query($del_catdata) === TRUE) {
                //echo "Record deleted successfully";
                header("Location: marketing_assets_view.php");
            } else {
                //echo "Error deleting record: " . $mysqli->error;
                header("Location: marketing_assets_view.php");
            }
       } 
    }
    } else {
        header("Location: marketing_assets_view.php");
    }

   
   
}
?>