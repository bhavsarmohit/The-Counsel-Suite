<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["adminname"]);
unset($_SESSION["adminemail"]);
unset($_SESSION["adminprofilepic"]);
header("Location:index.php");
?>