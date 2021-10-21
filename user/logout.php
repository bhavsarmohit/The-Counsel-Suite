<?php
error_reporting(0);
session_start();
require_once '../database/config.php';
$userid=$_SESSION["u_id"];
echo $userid;
$mysqli = new mysqli($hn,$un,"",$db);
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{
    $update_sql = "UPDATE users SET u_loginstatus='unactive' WHERE u_id='$userid'";
    if ($mysqli->query($update_sql) === TRUE) {
        session_start();
        unset($_SESSION["u_id"]);
        unset($_SESSION["u_name"]);
        unset($_SESSION["u_email"]);
        unset($_SESSION["u_profilepic"]);
        header("Location:../sign_in.php");
    } 

}
?>