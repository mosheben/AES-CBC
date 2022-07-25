


<?php
$message="";
if(isset($_POST['add_admin']))
{

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$date = date("F j, Y, g:i a");
$active = 1;
$status = 1;

    $doc_password = "1234";
    $hash_password = password_hash($doc_password,PASSWORD_BCRYPT, array('cost'=>12));
$query = "INSERT INTO admin_users(full_name,email,password,date,active,status) ";
$query .= "VALUES('{$full_name}','{$email}','{$hash_password}','{$date}','{$active}','{$status}') "; 
$create_admin_query = mysqli_query($connections,$query);
if(!$create_admin_query){
die('QUERY FAILED' . mysqli_error($connections));
}
$message = "User Created"."  " ."Password is " . $doc_password;
}

?>

<?php include "includes/admin_navigation.php"; ?>
                   
                      <?php
      if($message != "") {
 
       echo '<p class="bg-success">' ." ".  h($message) . '</p>';
      }
    ?>

      
<form  action="" method="post" enctype="multipart/form-data">
<div class="form-group">
   <label for="firstname"> Full Name </label>
   <input type="text" class="form-control"  name="full_name">
   </div>
   
    <div class="form-group">
   <label for="title">Email </label>
  <input type="email"  class="form-control" name="email">  
 </div>
 
 <div class="form-group">
<input type="submit" class="btn btn-primary" name="add_admin" value="Add Admin">
   </div>
  </div>
   
</form>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        
        
        <!-- /#page-wrapper -->
        
        <?php include "includes/admin_footer.php"; ?>

   
