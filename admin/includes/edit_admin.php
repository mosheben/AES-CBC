<?php

                     if(isset($_GET['ad_id']))
           {
            $the_id = sql_prep($_GET['ad_id']); 
           }




           $query = "SELECT * FROM admin_users WHERE admin_id = $the_id";
               $select_id = mysqli_query($connections,$query);
               
      
                     while ($row = mysqli_fetch_assoc($select_id))
            {
      $id = $row['admin_id'];
        $full_name= $row['full_name'];
        $email = $row['email'];
        $admin_password = $row['password'];
        
              }
              
              
              

                $message = "";
if(request_is_post() && request_is_same_domain()) {

if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
$message = "Sorry, request was not valid.";
}
else{
$full_name = sql_prep($_POST['full_name']);
$email = sql_prep($_POST['email']);


$query = "UPDATE admin_users SET ";
$query .="full_name = '{$full_name}', ";
$query .="email = '{$email}' ";
$query .="WHERE admin_id ={$the_id} ";

    $update_admin = mysqli_query($connections,$query);

$message = "Admin Updated";





  }}
                     
  



?>



<?php
 if($message != "") {
 
       echo '<p class="bg-success">' ." ".  h($message) . '</p>';
      }
    ?>


      
<form  action="" method="post" enctype="multipart/form-data">
  <?php echo csrf_token_tag(); ?>

<div class="form-group">
   <label for="firstname"> Full Name </label>
   <input type="text" class="form-control" value="<?php echo $full_name; ?>"  name="full_name">
   </div>
   
    <div class="form-group">
   <label for="title">Email </label>
  <input type="email"  class="form-control" value="<?php echo $email; ?>" name="email">  
 </div>
 
 <div class="form-group">
<input type="submit" class="btn btn-primary" name="edit_admin" value="Update Admin">
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

   
