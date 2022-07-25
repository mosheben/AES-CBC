<?php include "includes/admin_header.php"; ?>


    <div id="wrapper">
    
    
    <?php 
    
    
    ?>
    

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        
        
        
        
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <small>Role: Admin</small>
           Welcome to the  admin dashboard  <?php if(isset($_SESSION['admin_mail'])){
            
        $query = "SELECT  full_name FROM admin_users WHERE email  = '".$_SESSION['admin_mail']."'" ;
        $results = mysqli_query($connections,$query);
        $row = mysqli_fetch_assoc($results);
        $full_name = $row['full_name'];
        echo $full_name;
      
     
            }?>



                            </small>
                        </h1>
                        
                        
                         
                         
                         
                    </div>
                </div>
                <!-- /.row -->
                
                
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    
                     <?php
          $query = "SELECT * FROM doctors ";
          $select_all_doctors = mysqli_query($connections,$query);
          $doctors_count = mysqli_num_rows($select_all_doctors);
          
          echo "<div class='huge'>{$doctors_count}</div>";
          
          ?>
                    
                  
                        <div>Doctors</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    
                      <?php
          $query = "SELECT * FROM admin_users ";
          $select_all_admin_users = mysqli_query($connections,$query);
          $admin_users_count = mysqli_num_rows($select_all_admin_users);
          
          echo "<div class='huge'>{$admin_users_count}</div>";
          
          ?>
                    
                    
                      <div>Admin Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


 <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    
                     <?php
                    $query = "SELECT * FROM patients ";
                    $select_all_patients = mysqli_query($connections,$query);
                    $patients_count = mysqli_num_rows($select_all_patients);
                    
                    echo "<div class='huge'>{$patients_count}</div>";
                    
                    ?>
                    
                  
                        <div>Patients</div>
                    </div>
                </div>
            </div>
            <a href="">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>
                <!-- /.row -->
                
                
                
                
                
                
                

            </div>
            <!-- /.container-fluid -->

        </div>
        
        
        <!-- /#page-wrapper -->
        
        <?php include "includes/admin_footer.php"; ?>

   
  
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   