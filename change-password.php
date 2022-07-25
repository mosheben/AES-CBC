<?php include("functions/init.php"); ?>
 
  <?php  
 if(isset($_POST['change_password']))  
 {  
      $output = '';  
      $message = '';  

$new_password = mysqli_real_escape_string($connections,trim($_POST['new_password']));
$confirm_password = mysqli_real_escape_string($connections,trim($_POST['confirm_password']));

if ($new_password!=$confirm_password) {
   header('Location:list.php');
  $display_message = "<p class='alert alert-success text-center ' role='alert' >Password does not match confirm password</p>";
$_SESSION['display_message'] = $display_message; 
}
else{
$hash_password = password_hash($new_password,PASSWORD_BCRYPT, array('cost'=>12));
$query = "UPDATE doctors SET ";
$query .="password = '{$hash_password}' ";
$query .="WHERE id = '".$_SESSION['id']."'";
$update = mysqli_query($connections,$query);

if($update){
  echo '<script>alert("Data Saved");</script>';
  header('Location:list.php');
  $display_message = "<p class='alert alert-success text-center ' role='alert' >Profile Updated Successfully</p>";
$_SESSION['display_message'] = $display_message;
}
else{
  echo '<script>alert("Data not Saved"); </script>';
}

 }
  //header("Location: list.php");
     
    
 }  
 ?>