<?php
session_start();
$date=date("d/m/Y");
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
$mysqli = new mysqli($hn,$un,$pw,$db);
if ($mysqli -> connect_errno) {
  header("Location:view_marekting_assests.php"); 
}
else
{ 
  
$sql = "SELECT * FROM  marketing_assests WHERE c_id='$reterived_catid'";
$result = $mysqli->query($sql);
$userid=$_SESSION["u_id"];
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
     $subcatid=$row["c_catid"];
     $subcatname=$row["c_category"];
     $fname=$row["c_name"];
     $fdescription=$row["c_description"];
     $ffile=$row["c_file"];
  }
}
$check_exisiting="SELECT * FROM  favorites WHERE c_id='$reterived_catid' AND f_userid='$userid' AND parent_catname='marketing'"; 
$result = $mysqli->query($check_exisiting);
if ($result->num_rows > 0) {
  header("Location:view_marekting_assests.php"); 
}
else
{
  $add_fav="INSERT INTO `favorites`(`f_id`, `parent_catname`, `subcatid`, `sub_catname`, `c_id`, `f_name`, `f_description`,`f_file`, `f_adddate`, `f_userid`) VALUES (NULL,'marketing','$subcatid','$subcatname','$reterived_catid','$fname','$fdescription','$ffile','$date','$userid')";
  if ($mysqli->query($add_fav) === TRUE) {
    header("Location:view_marekting_assests.php"); 
 } else {
  header("Location:view_marekting_assests.php"); 
 }
}
}
?>