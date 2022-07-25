<?php //include("functions/init.php"); ?>
<?php include("functions/init.php"); ?>
<?php include("functions/functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>hospital</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="http://fonts.googleapis.com/css?family=Robost:400,500,700,300,100" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css
">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login_styles.css">
</head>
<body>

<div id="top"><!-- top start -->
<div class="container">
	<div class="col-md-6 offer">
		
		<a href="#" class="btn btn-success btn-sm">
			Welcome: Admin Login
		</a>

	</div>

<div class="col-md-6">
	<ul class="menu">
		
	
		<!--<li><a href="login.php">Login</a></li>-->
	</ul>
</div>
</div>
</div><!-- top ends -->




<?php
$message = "";
if(request_is_post() && request_is_same_domain()) {

if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
$message = "Sorry, request was not valid.";
}
else {
$email               = h($_POST['email']);
$password            = h($_POST['password']);
if(empty($email)){
$message="Email cannot be empty";
}
if(empty($password)){
$message="Password cannot be empty";
}
else{
$sql = "SELECT password, status, admin_id  FROM admin_users WHERE email = '".sql_prep($email)."' AND active = 1  ";
$result = query($sql);
//if we found somebody
if(row_count($result)== 1){
$row = fetch_array($result);
//$_SESSION['id'] = $row['id'];
//$_SESSION['status'] = $row['status'];
$db_password = $row['password'];
$admin_id = $row['admin_id'];
//password verification   
if($password != $row['password']){
$message="Your Credentials Are Not Correct" ;
}	
//if we are able to find the password
if(password_verify($password, $db_password)){
//redirect to admin page if user is an admin
if($row['status']==='1'){
$_SESSION['is_admin']=  '1'; 
redirect('index.php');
}
//redirect to users page if user == user
elseif ($row['status'] === '0') {
$_SESSION['not_admin'] = '0';
redirect('approval.php');
}

$_SESSION['email'] = $email;
//   return true;
}
}else{
$message= "Your Credentials Are Not Correct or activate your account";
}
}

}		
}
?>




<style type="text/css">
	.form-signin {
  max-width: 400px; 
  display:block;
  background-color: #f7f7f7;
  -moz-box-shadow: 0 0 3px 3px #888;
    -webkit-box-shadow: 0 0 3px 3px #888;
	box-shadow: 0 0 3px 3px #888;
  border-radius:2px;
}
.main{
	padding: 38px;
}
.social-box{
  margin: 0 auto;
  padding: 38px;
  border-bottom:1px #ccc solid;
}
.social-box a{
  font-weight:bold;
  font-size:18px;
  padding:8px;
}
.social-box a i{
  font-weight:bold;
  font-size:20px;
}
.heading-desc{
	font-size:20px;
	font-weight:bold;
	padding:38px 38px 0px 38px;
	
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: 20px;
  padding: 20px;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: 10px;
  border-radius: 5px;
  
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-radius: 5px;
}
.login-footer{
	background:#f0f0f0;
	margin: 0 auto;
	border-top: 1px solid #dadada;
	padding:20px;
}
.login-footer .left-section a{
	font-weight:bold;
	color:#8a8a8a;
	line-height:19px;
}
.mg-btm{
	margin-bottom:20px;
}

label.error
{
	color: #dc3545 !important;
}

#load-screen {
background:url(images/head.gif);
position: fixed;
z-index: 10000;
top:0px;
width: 100%;
height: 1600px;

}


#loading {

width: 500px;
height: 500px;
margin: 8% auto;
background: url(images/loader.gif);
background-size: 30%;
background-repeat: no-repeat;
background-position: center;

}
#logs{
	display: none;
}

@media (max-width: 768px) {
	#logs{
	display: block;
}

#loading {

width: 400px;
height: 400px;
margin: 10% auto;
background: url(images/loader.gif);
background-size: 40%;
background-repeat: no-repeat;
background-position: center;

}


}

@media (max-width: 344px){
#loading {

width: 300px;
height: 300px;
margin: 45% auto;
background: url(images/loader.gif);
background-size: 50%;
background-repeat: no-repeat;
background-position: center;

}
}
</style>



<div class="container">
	<div class="row">

		<div class="col-md-4 col-md-offset-4">

		<form class="form-signin mg-btm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="myform">
			<?php echo csrf_token_tag(); ?>
    	<h3 class="heading-desc">
		<button type="button" class="close pull-right" aria-hidden="true">×</button>
		Admin Login </h3>
		
		<div class="main">	
       <?php 
         
         if(isset($_SESSION['display_message'])){
         	 echo $_SESSION['display_message'];  
         	 unset($_SESSION['display_message']);//so that the message will not stay there all the time
         }
      


       ?>

				             <?php
      if($message != "") {
 
      echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>' ." ".  h($message) . '</div>';
     }
    ?>
		<input type="text" class="form-control" name="email" id="email" placeholder="Enter your email" autofocus value="<?php if (isset($email)) { echo $email; } ?>" required>

        <input type="password" id="password" name="password" class="form-control" placeholder="Password"  required>
		 
    
<span class="clearfix"></span>	
</div>
<div class="login-footer">
<div class="row">

<center><div class="col-xs-12 col-md-12 ">
<button type="submit" id="pageDemo1" class="btn btn-large btn-danger btn-lg"><i class="fa fa-sign-in"></i> Login</button>
</div></center>



</div>
		
		</div>
      </form>
	</div>
</div>
</div>





<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

 <script>
	$(document).ready(function() {
		$("#myform").validate({
                
		}); //validate
	}); //document ready
</script>


<script>
		 var div_box = "<div id='load-screen'><div id='loading'></div></div>";
		 
		 $("body").prepend(div_box);
		 
		 $('#load-screen').delay(1000).fadeOut(1200, function(){
	               
					$(this).remove();						  
											  
			});
		 </script>
   
