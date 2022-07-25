    
                          <form action="" method="post">
                          
                          <div class="form-group">
                        
                          
                          <h3 class="text-muted">Edit Doctor</h3>
                          
                           
						  <?php  // Edit Category
						 
						  
						 if(isset($_GET['edit'])){
							 
							 $id = $_GET['edit'];
							
							  $query = "SELECT * FROM doctors WHERE id = $id";
			              $select_categories_id = mysqli_query($connections,$query);
						
                            while ($row = mysqli_fetch_assoc( $select_categories_id ))
							
							{
				 $id = $row['id'];
$doc_id = $row['doctor_id'];
$doc_name = $row['full_name'];
$email = $row['email'];

				
							}
							 ?>
                              
			<input  value="<?php if(isset($doc_id)){ echo $doc_id ;}  ?>" class = "form-control" type="text" name="doc_id">  
 </div>
             <div class="form-group">

			<input  value="<?php if(isset($doc_name)){ echo $doc_name ;}  ?>" class = "form-control" type="text" name="doc_name"></div>

			 <div class="form-group">

			<input  value="<?php if(isset($email)){ echo $email ;}  ?>" class = "form-control" type="text" name="email"></div>
							 
					<?php }   ?> 
                    
                    <?php  //INSERTING THE EDIT DATA INTO THE DATABASE /UPDATE QUERY
					
					if(isset($_POST['update_category'])){
				$doc_name = $_POST['doc_name'];
                $email = $_POST['email'];
                $doc_id = $_POST['doc_id'];

				$query = "UPDATE doctors SET ";
                $query .="doctor_id = '{$doc_id}', ";
                $query .="full_name = '{$doc_name}', ";
                $query .="email = '{$email}' ";
                $query .="WHERE id ={$id} ";
                $update_query = mysqli_query($connections,$query);
					}
					
					
					
					 ?>
						 
                        
						  
						  
						
                         
                          
                         
                          
                           <div class="form-group">
                          <input  class="btn btn-primary"type="submit" name ="update_category" value="Update Doctor"> 
                          </div>
                          
                          </form>
                          