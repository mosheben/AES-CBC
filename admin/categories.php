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
                          
                          <div class="col-xs-6">
                          
                          <?php   // Add Categories 
						  
						  
						  insert_categories();
						  
						  
						  
						
						  ?>
                         
                          <form action="" method="post">
                            <h3 class="text-muted">Register New Doctor</h3>
                          <div class="form-group">
                          <input class = "form-control" type="text" name="doc_name" placeholder="Full Name"> 
                          </div>
                                 
                                 <div class="form-group">
                          <input class = "form-control" type="email" name="email" placeholder="Email"> 
                          </div>

                           <div class="form-group">
                          <input  class="btn btn-primary"type="submit" name ="submit" value="Add Doctor"> 
                          </div>
                          
                          </form>
                          
                          <?php  //  UPDATE AND INCLUDE QUERY
						  
						  if(isset($_GET['edit'])){
							$id = $_GET['edit'];
							
							include "includes/update_categories.php";  
							  
						  }
						  
						  
						  
						  ?>
                          
                      
                          </div><!--Add Category Form -->
                          
                            
                            
                            
                            
                            
                            
                            <div class="col-xs-6">
                            
               <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                            
                            <th>Doctor Id</th>
                            
                            <th>Name</th>
                            <th>Email</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            
                             <?php
							 
							 // Display All Categories Queries In The Table/Database
							 
							 findAllCategories();
				
                                    ?> 
                                    
                                    
                
                <?php // DELETE CATEGORIES QUERY 
				deleteCategories();
				
				?>
                
                
                            </tbody>
                            
                            
                            </table>
                            
                            
                            </div>
                          
                         
                    </div>
                </div>
                <!-- /.row -->
</div>
            </div>
            <!-- /.container-fluid -->

        </div>
        
        
        <!-- /#page-wrapper -->
        
        <?php include "includes/admin_footer.php"; ?>

   