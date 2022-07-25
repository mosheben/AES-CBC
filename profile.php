<?php include("functions/init.php"); ?>
 
  <?php  
 if(isset($_POST['profile']))  
 {  
      $output = '';  
      $message = '';  

$profile_name = mysqli_real_escape_string($connections,trim($_POST['profile_name']));
$profile_email = mysqli_real_escape_string($connections,trim($_POST['profile_email']));

$query = "UPDATE doctors SET ";
$query .="full_name = '{$profile_name}', ";
$query .="email = '{$profile_email}' ";
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

 
  //header("Location: list.php");
     
    
 }  
 ?>