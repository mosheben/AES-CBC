  <table class="table table-bordered table-hover">
                        
                        <thead>
                           
                           <tr>
                           
                           <th>#</th>
                           <th>Full Name</th>
                           <th>Email</th>
                           <th>Date</th>
                           
                          
                           
                           </tr>
                        
                            </thead>
                        
                        <tbody>
                    
                    <?php 
					
					 $query = "SELECT * FROM  admin_users ";
			$select_users = mysqli_query($connections,$query);
							 
			$i=0;
                            while ($row = mysqli_fetch_assoc($select_users)){
				$admin_id = $row['admin_id'];
				$full_name = $row['full_name'];
				$admin_email = $row['email'];
				$active = $row['active'];
				$date = $row['date'];
				$i++;
				echo "<tr>";
				echo "<td> {$i} </td>";
				echo "<td>	{$full_name} </td>";
				echo "<td> {$admin_email} </td>";
				echo "<td> {$date} </td>";
				
				


				echo "<td> <a href='users.php?source=edit_admin&ad_id={$admin_id}'>Edit </a></td>";

				echo "<td> <a onClick=\"javascript:return confirm ('Are you sure you want to delete Account');\" href='admin_users.php?delete={$admin_id}'>Delete </a></td>";

				
				
				echo "</tr>";
				
							}
					
					
					
					
					?>
                    </tbody>
                    </table>
                    
                    <?php

					
					
					//deleting user
					if(isset($_GET['delete'])){
					$the_admin_id = sql_prep($_GET['delete']);
					$query = "DELETE FROM admin_users WHERE id = {$the_admin_id} ";
					$delete_admin_query = mysqli_query($connections,$query);
						header("Location: users.php");
						
					}
			
					
					
					?>
                    
                    
                    
                    
                    
                        
                        
                       
                        
                       
                        </tbody>
                        
                        </table>  