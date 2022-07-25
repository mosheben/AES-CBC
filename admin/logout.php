<?php include("functions/init.php"); ?>
<?php include("functions/functions.php"); ?>
<?php
	
	session_destroy();
	unset($_SESSION['email']);
	unset($_SESSION['admin']);

//check if we have a cookie
if(isset($_COOKIE['email'])){
	
	unset($_COOKIE['email']);
	
	setcookie('email', '' , time()-60);
	
}


redirect("login.php");
	


?>