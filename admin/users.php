<?php include "includes/admin_header.php"; ?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        
        
        
        
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                          <h1 class="page-header">
                           Welcome To Admin
                            <small>Author</small>
                        </h1>
                        
                     <?php   
					 
					 if(isset($_GET['source'])    ){
						 $source = $_GET['source'];
						 
					 }
					 else{
						$source = ''; 
					 }
					 switch($source){
						 
						 case 'add_admin';
					      include "includes/add_admin.php";
						 break;
						 
						 case 'edit_admin';
					  include "includes/edit_admin.php";
						 break;
						 
						 case '34';
						 echo 'nice 32';
						 break;
						 
						 default:
						 
						 include "includes/view_all_admin.php";
						 
					 }
					 
					 
					 
					 
					  ?>
                         
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        
        
        <!-- /#page-wrapper -->
        
        <?php include "includes/admin_footer.php"; ?>

   