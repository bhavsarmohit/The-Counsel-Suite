<?php 
session_start();
$adminid=$_SESSION['id'];
$upload = 'err';
$date = date('Y/m/d H:i:s');
require_once '../../database/config.php';
$mysqli = new mysqli($hn,$un,$pw,$db); 
$contract_id=$_POST['c_id'];
  
if(!empty($_FILES['file'])){ 
      // File upload configuration 
      $targetDir = "../../documents/marketing/"; 
      $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
       
      $fileName = basename($_FILES['file']['name']); 
      $targetFilePath = $targetDir.$fileName; 
       
      // Check whether file type is valid 
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
      $check_credentials="select * from marketing_assests where c_file='$fileName'";
      $raw=mysqli_query($mysqli,$check_credentials);
      $count=mysqli_num_rows($raw);
    if($count>0)
    {
      $upload='already_cat';
    }
    else
    {
      $sql1 = "SELECT c_file FROM marketing_assests WHERE c_id='$contract_id'";
      $result = $mysqli->query($sql1);
      
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $prev_filename= $row["c_file"];
        }
      }       
          if(in_array($fileType, $allowTypes)){ 
              if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
                $file_pointer = "../../documents/marketing/".$prev_filename; 
                if (!unlink($file_pointer)) { 
                    //header("Location: legal_contracts_view.php");
                }
                $sql = "UPDATE marketing_assests SET c_file='$fileName' WHERE c_id='$contract_id'";
                  if ($mysqli->query($sql) === TRUE) {
                      $upload='ok';
                 } else {
                     $upload='err';
                }
                  }           
              }   
          }
        }      
echo $upload; 
?>