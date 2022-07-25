<?php include("functions/init.php"); ?>


<?php
	
	session_destroy();
	unset($_SESSION['doc_id']);
     unset($_SESSION['doctor_id']);
//check if we have a cookie
if(isset($_COOKIE['doc_id'])){
	
	unset($_COOKIE['doc_id']);
	
	setcookie('doc_id', '' , time()-60);
	
}


redirect("index.php");
	


?>