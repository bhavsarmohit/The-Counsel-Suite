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
      $targetDir = "../../documents/legal/"; 
      $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
       
      $fileName = basename($_FILES['file']['name']); 
      $targetFilePath = $targetDir.$fileName; 
       
      // Check whether file type is valid 
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
      $check_credentials="select * from legal_contracts where c_file='$fileName'";
      $raw=mysqli_query($mysqli,$check_credentials);
      $count=mysqli_num_rows($raw);
    if($count>0)
    {
      $upload='already_cat';
    }
    else
    {
      $sql1 = "SELECT c_file FROM legal_contracts WHERE c_id='$contract_id'";
      $result = $mysqli->query($sql1);
      
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $prev_filename= $row["c_file"];
        }
      }       
          if(in_array($fileType, $allowTypes)){ 
              if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
                $file_pointer = "../../documents/legal/".$prev_filename; 
                if (!unlink($file_pointer)) { 
                    //header("Location: legal_contracts_view.php");
                }
                $sql = "UPDATE legal_contracts SET c_file='$fileName' WHERE c_id='$contract_id'";
                  if ($mysqli->query($sql) === TRUE) {
                      $upload='ok';
                 } else {
                     $upload='err';
                }
                  }           
              }   
          }
        }  

/*$check_credentials="select * from legal_contracts where c_name='$nameContract'";
  $raw=mysqli_query($mysqli,$check_credentials);
  $count=mysqli_num_rows($raw);
  if($count>0)
  {
    $upload='already_cat';
  }
  else
  {
    if(!empty($_FILES['file'])){ 
     
    
      // File upload configuration 
      $targetDir = "../../documents/legal/"; 
      $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
       
      $fileName = basename($_FILES['file']['name']); 
      $targetFilePath = $targetDir.$fileName; 
       
      // Check whether file type is valid 
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
      $check_credentials="select * from legal_contracts where c_file='$final_filename'";
    $raw=mysqli_query($mysqli,$check_credentials);
    $count=mysqli_num_rows($raw);
    if($count>0)
    {
      $upload='already_cat';
    }
    else
    {
     
          if(in_array($fileType, $allowTypes)){ 
              // Upload file to the server 
              if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
                  $sql = "INSERT INTO legal_contracts (c_id,c_name,c_description,c_catid,c_category,c_parentcat,c_file,c_timestamp,c_adminid)VALUES (NULL,'$nameContract','$desc','$cat_id','$cat_name','legal','$final_filename','$date','$adminid')";
                  if ($mysqli->query($sql) === TRUE) {
                      $upload='ok';
                    } else {
                      $upload='err';
                    }
                  }           
              }   
          }  
        }
  }
  */
    
echo $upload; 
?>