
<style type="text/css">
.modal-login {
		color: #636363;
		width: 350px;
	}
	.modal-login .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
	}
	.modal-login .modal-header {
		border-bottom: none;
		position: relative;
		justify-content: center;
	}
	.modal-login h4 {
		text-align: center;
		font-size: 26px;
	}
	.modal-login  .form-group {
		position: relative;
	}
	.modal-login i {
		position: absolute;
		left: 13px;
		top: 11px;
		font-size: 18px;
	}
	.modal-login .form-control {
		padding-left: 40px;
	}
	.modal-login .form-control:focus {
		border-color: #00ce81;
	}
	.modal-login .form-control, .modal-login .btn {
		min-height: 40px;
		border-radius: 3px; 
	}
	.modal-login .hint-text {
		text-align: center;
		padding-top: 10px;
	}
	.modal-login .close {
        position: absolute;
		top: -5px;
		right: -5px;
	}
	.modal-login .btn {
		background: #00ce81;
		border: none;
		line-height: normal;
	}
	.modal-login .btn:hover, .modal-login .btn:focus {
		background: #00bf78;
	}
	.modal-login .modal-footer {
		background: #ecf0f1;
		border-color: #dee4e7;
		text-align: center;
		margin: 0 -20px -20px;
		border-radius: 5px;
		font-size: 13px;
		justify-content: center;
	}
	.modal-login .modal-footer a {
		color: #999;
	}
	

	#head{
 border-bottom: 0;
}

#foot{
	border-top: 0;
}
h3{
	margin:0;
	padding: 0;
}
</style>











<!-- Add patient -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title ">Add Patient</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form action="add_patient.php" id="myform" method="POST" >
			<div class="modal-body">
				
				<div class="form-group">
						<i class="fa fa-user"></i>
						
						<input name="patient_name" type="text" class="form-control validate" placeholder="Patient Name" id="patient_name" required="required">					
					</div>


					<div class="form-group">
						<i class="fa fa-calculator"></i>
						
						<input name="patient_age" type="text" class="form-control validate" placeholder="Patient Age" id="patient_age" required="required">					
					</div>
				

				 <div class="form-group">
						
						<i class="fa fa-home"></i>

				<select name="gender" class="form-control" required>
								<option disabled selected hidden>Gender</option>
								<option>Male</option>
								<option>Female</option>
								
								
							</select>
							</div>

				

					<div class="form-group">
						<i class="fa fa-calculator"></i>
						
						<input name="bed_number" type="text" class="form-control validate" placeholder="Bed Number" id="text" required="required">					
					</div>


    <div class="form-group">

	<textarea name="symptons" rows="3" cols="50" class="form-control" placeholder="Symptons"></textarea>
				</div>
					
							
				
			</div>

			<div class="modal-footer">
			<button type="submit" name="add_patient"  class="btn btn-primary btn-block btn-lg" style="background: #F0677C;color: white;">Add Patient</button>
		
			</div>
			</form>
		</div>
	</div>
</div>    





<!-- my profile-->
<div id="myProfile" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title ">Profile</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form action="profile.php" id="myform" method="POST" >
			<div class="modal-body">
				
				<div class="form-group">
						<i class="fa fa-user"></i>
						
						<input name="profile_name" type="text" class="form-control validate" placeholder="Full Name" id="profile_name" required="required">					
					</div>


					<div class="form-group">
						<i class="fa fa-calculator"></i>
						
						<input name="profile_email" type="text" class="form-control validate" placeholder="Profile Email" id="profile_email" required="required">					
					</div>

					
							
				
			</div>

			<div class="modal-footer">
			<button type="submit" name="profile"  class="btn btn-primary btn-block btn-lg" style="background: #F0677C;color: white;">Update Profile</button>
		
			</div>
			</form>
		</div>
	</div>
</div>    

<!-- change password-->
<div id="changePassword" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title ">Change Password</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form action="change-password.php" id="myform" method="POST" >
			<div class="modal-body">
				
				<div class="form-group">
						<i class="fa fa-key"></i>
						
						<input name="new_password" type="password" class="form-control validate" placeholder="New  Password" id="new_password" required="required">					
					</div>


					<div class="form-group">
						<i class="fa fa-key"></i>
						
						<input name="confirm_password" type="password" class="form-control validate" placeholder="Confirm Password" id="confirm_password" required="required">					
					</div>

					
							
				
			</div>

			<div class="modal-footer">
			<button type="submit" name="change_password"  class="btn btn-primary btn-block btn-lg" style="background: #F0677C;color: white;">Update Password</button>
		
			</div>
			</form>
		</div>
	</div>
</div>    





<!-- view patients modal -->


<!-- forgot modals -->
  <div class = "modal fade" id = "new" role = "dialog">
            <div class = "modal-dialog modal-lg">
               <div class = "modal-content">
                  <div class = "modal-header">      
                     <button type = "button" class="close" data-dismiss = "modal">×</button>
                     <h4 class = "modal-title">Patient</h4>
                  </div>
                  <div class = "modal-body">
                 
              <iframe width="100%" height="550" src="http://192.168.43.1:8080/greet.html" frameborder="0" allowfullscreen></iframe>
			 </div>
                 
                  
               </div>
            </div>
         </div>



<!-- forgot modals ends-->
