<?php

//php mailer
use PHPMailer\PHPMailer\PHPMailer;


include_once "PHPMailer/PHPMailer.php";

include_once "PHPMailer/Exception.php"; 




//count the row of record in our database

function row_count($result){
	global $connections;
	
	return mysqli_num_rows($result);
	
}



//escape string function (sql injection)
function escape($string){
	
global $connections;
	
	return mysqli_real_escape_string($connections, $string);
	
	
}



//send query function
function query($query){
	
	global $connections;
	
	$result = mysqli_query($connections,$query);
	
	confirm($result);
	
	return $result;
}

//function for sticky form
function getInputValue($name){
	global $connections;
if(isset($_POST[$name])){
echo $_POST[$name];
}
}


//function to set first letter to upper case
function sanitizeFormString($inputText){
global $connections;
    $inputText = ucfirst(strtolower($inputText));// first letter to upper case & the rest lower case
    return $inputText;
    
    
}

//check if for errors
function confirm($result){
	
	global $connections;
	
	if(!$result){
		
		die("QUERY FAILED" . mysqli_error($connections));
	}
	
	
}

//function to fetch data from the database
function fetch_array($result){
	
	global $connnections;
	
	return mysqli_fetch_array($result);
	
}




?>







<?php

/*********************Helper functions *************/
//clean input field function
function clean($string){
	global $connections;
	

	return htmlspecialchars($string);

}

//redirection function
 function redirect($location){
	 global $connections;
	 return header("Location: {$location}");
	 
	 
 }


//set message
function set_message($message){
	global $connections;
	
	if(!empty($message)){
		
		$_SESSION['message'] = $message;
		
		
	}
	else{
		$message = "";
	}
	
	
}

//display message
function display_message(){
	global $connections;
	if(isset($_SESSION['message'])){
		
		echo $_SESSION['message'];
		
		unset($_SESSION['message']);//so that the message will not stay there all the time
		
	}
	
	
	
}


function token_generator(){
	global $connections;
	$token = $_SESSION['token'] =  md5(uniqid(mt_rand(), true));
	
	return $token;
	
}


//funtion to display error
function display_validation_error($error_message){
	global $connections;
	$error_message = <<<DELIMITER
			
<div class="alert alert-danger alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> $error_message 
		 	</div>
			
DELIMITER;
			
			return $error_message;
			
	
	
}



function email_exit($email){
	
	global $connections;

	$sql = "SELECT id FROM admin_users WHERE email = '{$email}'";
	
	$result = query($sql);
	
	if(row_count($result)==1){
		
		return true;
		
	}
	else{
		
		return false;
	}
}



//function to check if email already exit
function bed_exit($bed){
	
	global $connections;

$sql = "SELECT bed_id FROM beds WHERE bed_number = '{$bed_number}'";
	
	$result = query($sql);
	
	if(row_count($result)==1){
		
		return true;
		
	}
	else{
		
		return false;
	}
}

function course_exit($the_cid,$the_user_id){
	
	global $connections;

	$sql = "SELECT course_id,user_id FROM enroll WHERE course_id='$the_cid' AND user_id = '".$_SESSION['user_id']."'";
	$result = query($sql);
	$row = fetch_array($result);
	$course_id = $row['course_id'];
	$user_id = $row['user_id'];
	
	if($course_id===$the_cid && $user_id===$_SESSION['user_id']){
		
		return true;
		
	}
	else{
		
		return false;
	}
}








//send successful registration mail function
function send_email($email, $subject, $msg, $headers){
	//global $connections;
    
    
    $mail = new PHPMailer();
    $mail->addAddress($email);
    $mail->setFrom('donotreply@critacghana.com','Critac Education');
    
    $mail->Subject = $subject;
    $mail->isHTML(true);
    $mail->CharSet= 'UTF-8';
    $mail->Body = $msg;
    
    if($mail->send()){
        echo 'Message has been sent';
    }else{
        
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        
    }
    
    
	//return mail($email, $subject, $msg, $headers);
	
	
	
}








  



//function activate_user()

    function activate_user(){
	global $connections;
	    if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	      if(isset($_GET['email'])){ 
		     
		   $email = clean($_GET['email']);
		
		   $validation_code = clean($_GET['code']);
		
		$sql = "SELECT id FROM users WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code'])."' ";
		
		$result = query($sql);
		confirm($result);
		
		//if the user was found
		if(row_count($result) == 1){
			
         $sql2 = "UPDATE users SET active = 1, validation_code = 0 WHERE email = '".escape($email)."'  AND validation_code = '".escape($validation_code)."' ";
			
			
		$result2= query($sql2);
		confirm($result2);
			
		set_message("<p class='bg-success'>Your account has been activated please login </p>");
	      
			redirect("login.php");
	
		}else{
			
			set_message("<p class='bg-danger'>Sorry Your account could not be activated </p>");
			redirect("login.php");
			
		}
	
	
}
}

}//activate user ends


/*************************Validate user login functions*******************/

function validate_user_login(){
	global $connections;
	$errors = [];
	$min = 3;
	$max = 20;
	
	
	//post request function
	
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	      
		
		
		  $email               = clean($_POST['email']);
		  $password            = clean($_POST['password']);
		  $remember            = isset($_POST['remember']);
		  
		   if(empty($email)){
			   
			   $errors[]= "Email field cannot be empty";
			   
		   }
		
		  
		 
		   if(empty($password)){
			   
			   $errors[]= "Password field cannot be empty";
			   
		   }
		
		  
		
		  
		if(!empty($errors)){
		
		foreach($errors as $error){
			
			//Display error code here
                  echo display_validation_error($error);
			
		}
	}else{     
			       
			    //if login succeed go homepage
	        	if(login_user($email,$password,$remember)){
					
					return true;
					
				}else{
					
					echo display_validation_error("Your Credentials Are Not Correct");
					
				}	
	  		
		}
	     
	
		
	}
	
	
	
}


/************************* user login functions*******************/

function login_user($email,$password,$remember){
	
	global $connections;
	         
$sql = "SELECT password, status, id  FROM users WHERE email = '".escape($email)."' AND active = 1  ";
	    $result = query($sql);  
    
  
	
	//if we found somebody
	if(row_count($result)== 1){
        
    
        
          $row = fetch_array($result);
    $_SESSION['id'] = $row['id'];
    $_SESSION['status'] = $row['status'];
        $db_password = $row['password'];
		   
		
		//if we are able to find the password
	
        if(password_verify($password, $db_password)){


            
          if($row['status']=='admin'){
            
            $_SESSION['admin']=  'admin';
          
            redirect('admin/index.php');
        }
        elseif ($row['status'] == 'user') {
           $_SESSION['user'] == 'user';
        	redirect('paper.php');
        }


            if($remember == "on"){
                
                setcookie('email',$email,time(),+86400);
            }
            
        
		
            $_SESSION['email'] = $email;
            
            return true;
            
            
        }
         
        else{
            
            return false;
        }
		
		
		return true;   
		   
	   }
	//else if we find nobody 
	else{
		
		 return false;
		
	}
	         
	
	
	
}//end of function


/**********************  logged in function           *****************/


function logged_in(){
    global $connections;
	
	if(isset($_SESSION['email'])  || isset($_COOKIE['email'])){
		
		return true;
		
	}
	
	else{
		
		return false;
	}
	
}//function end











/**********************  Recover Password function      *****************/


 function recover_password(){
	 global $connections;
	 if($_SERVER['REQUEST_METHOD'] == "POST"){
		 
		 if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']){
			 
			 $email = clean($_POST['email']);

			 if(empty($email)){
			 	 echo display_validation_error("Email field cannot be empty");
			 }
			 
			 if(email_exit($email))
			 {
				 $validation_code = md5($email . microtime());
					  
					
		 //setting cookie so that forgot validation code will not be available all the time

						setcookie('temp_access_code', $validation_code , time()+900);
						//setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);

				 //inserting the validation code of the user inside the database
				 $sql = "UPDATE users SET validation_code = '".escape($validation_code)."' WHERE email = '".escape($email)."'";
				 
				 $result = query($sql);
				 confirm($result);
				 

				$query = "SELECT full_name FROM users WHERE email = '$email'";
$send_query = query($query);
confirm($send_query);

$row = mysqli_fetch_assoc($send_query);
                      
                   $full_name = $row['full_name'];

				 $subject = "Please reset your password";
				  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; 
				  $message = "
                 
                 Dear $full_name Here is your password reset link, click the link below 
                
		
	<a href =\"$actual_link/courses/reset.php?email=$email&code=$validation_code\"> <br>
    
                         click here to reset password </a> ";
	
				// $headers = "From: richempire.com";
				 
				 if(!send_email($email , $subject, $message  , $headers)){
					 
					 echo display_validation_error("Email could not be sent");
					 
				 }
				 
				 set_message("<p class='alert alert-success text-center '>Please check your email or spam folder for a password reset code</p>");
				 
				 redirect("login.php");
			 }
			 
			 else{
				 
				 echo display_validation_error("This email does not exist");
			 }
			 
		 }else{
			 
			 //if the token is not the same or set ;that generator
			 redirect("login.php");
		 }
		 
		 //if cancel is clicked
		 if(isset($_POST['cancel_submit'])){
			 
			 redirect("login.php");
			 
		 }
	 }
	 
	 
 }//function end


/**********************  code validation function      *****************/


function validate_code(){
	global $connections;
	if(isset($_COOKIE['temp_access_code'])){
		
		
			if(!isset($_GET['email']) && !isset($_GET['code'])){
				
				redirect("index.php");
				
			}elseif(empty($_GET['email']) || empty($_GET['code'])){
				
				redirect("index.php");
				
			}else{
				
				if(isset($_POST['code'])){
					
	$email = clean($_GET['email']);
	$validation_code = clean($_POST['code']);
	$sql = "SELECT id FROM users WHERE validation_code = '".escape($validation_code)."' AND email ='".escape($email)."' ";
					$result = query($sql);
					
					//if code is true or found
					if(row_count($result) == 1){
						
$path = '/';
$domain = 'www.paper.critacghana.com';
$secure = isset($_SERVER['HTTPS']);
$httponly = true; // JavaScript can't access cookie

						setcookie('temp_access_code', $validation_code , time()+900,$path,$domain,$secure,$httponly);
						//setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
						//varifying that the user was from code.php 
						redirect("reset.php?email=$email&code=$validation_code");
						
						
					}else{
						//if code is not found 
						echo display_validation_error("Sorry wrong validation code");
					}
					
					
				}
				
			}
		
		
	}else{
		
 set_message("<p class='bg-danger text-center'>Sorry your validation cookie was expired </p>");
		
		redirect("recover.php");
	}

	
	
}//function end



/**********************  password reset function      *****************/

function password_reset(){
	global $connections;
	if(isset($_COOKIE['temp_access_code'])){

		if(!isset($_GET['email']) && !isset($_GET['code'])){
				
				redirect("index.php");
				
			}elseif(empty($_GET['email']) || empty($_GET['code'])){
				
				redirect("index.php");
				
			}else{
		 
                    
		if(isset($_GET['email']) && isset($_GET['code'])){
		
	//if our token and post token are the same
		if(isset($_SESSION['token']) && isset($_POST['token'])){
		   
		   if($_POST['token']=== $_SESSION['token']){
		   	$email = clean($_GET['email']);
	        $validation_code = sql_prep($_GET['code']);
           
		   	$sql = "SELECT id FROM users WHERE validation_code = '".escape($validation_code)."' AND email ='".escape($email)."' ";
                  $result = query($sql);

                 if(row_count($result) == 1){
		   	$password = sql_prep($_POST['password']);
		   	$confirm_password = sql_prep($_POST['confirm_password']);

		   	$password = dirty_html($password);
		   	$confirm_password = dirty_html($confirm_password);

		   	$password = h($password);
		   	$confirm_password = h($confirm_password);
			   
			   if($password === $confirm_password){			   
				   $updated_password = password_hash($password,PASSWORD_BCRYPT, array('cost'=>12));
				   
				   //updating the new passwords
			   $sql = "UPDATE users SET password = '".escape($updated_password)."',validation_code = 0, active=1 WHERE email ='".escape($_GET['email'])."'";
				   
				   query($sql);
				    set_message("<p class='alert alert-success text-center '>Your password has been updated, please login</p>");
				   
			   redirect("login.php");
				   
			   }else{
				   
				   echo display_validation_error("Password fields don't match");
			   }
			   
		   }else{
		   	set_message("<p class='alert alert-danger text-center '>Sorry your password cannot be recovered, please use the link provided in the reset email. </p>");
		   	redirect("forgot.php");
		   }
		}
	      
		
		
	}
	
}
}	
	}else{


		
		set_message("<p class='alert alert-danger text-center '>Sorry your time has expired </p>");
		redirect("forgot.php");
		
	}

}


?>