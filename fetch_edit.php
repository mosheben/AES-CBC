 <?php include("functions/init.php"); ?>
<?php  

 if(isset($_POST["id"]))  
 {  
 	$_SESSION['the_id']=$_POST['id'];
      $query = "SELECT * FROM doctors WHERE id = '".$_POST["id"]."'";  
      $result = mysqli_query($connections, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>