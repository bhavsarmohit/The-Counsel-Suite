<?php
error_reporting(0);
session_start();
require_once '../../database/config.php';
if(isset($_SESSION["u_id"])) {
  if(isset($_GET['id'])) {
    $reterived_catid=$_GET['id'];  
    }
  else
  {
    header("Location: ../index.php");
  }
  
 
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
    $del_catdata="DELETE FROM `favorites` WHERE `f_id`=$reterived_catid";
    if ($mysqli->query($del_catdata) === TRUE) {
        echo "Record deleted successfully";
        header("Location: view_marketing_favorites.php");
      } else {
        echo "Error deleting record: " . $mysqli->error;
        header("Location: view_marketing_favorites.php");
      }
   
}
?>