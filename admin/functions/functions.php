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





function email_exit($email){
	
	global $connections;

	$sql = "SELECT admin_id FROM admin_users WHERE email = '{$email}'";
	
	$result = query($sql);
	
	if(row_count($result)==1){
		
		return true;
		
	}
	else{
		
		return false;
	}
}






function ConfirmQuery($result){
global $connections;

if(!$result)
{
die("QUERY FAILED " .mysqli_error($connections));	

}
}



function insert_categories()

{
global $connections;
$message = "";
if(isset($_POST['submit']))
{

$doc_name = $_POST['doc_name'];
$email = $_POST['email'];

if(empty($doc_name)){
$message = "Doctor name field should not be empty ";
}

if(empty($email)){
$message = "Email field should not be empty ";
}


if(!$message)
{
    $doc_id =  substr(number_format(time() * rand(),0,'',''),0,6);
    $doc_password = $doc_id;
    $hash_password = password_hash($doc_password,PASSWORD_BCRYPT, array('cost'=>12));
$query = "INSERT INTO doctors(doctor_id,full_name,email,password) ";
$query .= "VALUES('{$doc_id}','{$doc_name}','{$email}','{$hash_password}') ";	
$create_category_query = mysqli_query($connections,$query);
if(!$create_category_query){
die('QUERY FAILED' . mysqli_error($connections));
}
else{
echo "<span class='text-info'> Doctor Added </span>";	
}
}

}

echo "<span class='text-danger'>".$message."</span>";
}




function findAllCategories() {

global $connections;

$query = "SELECT * FROM doctors ";
$select_categories = mysqli_query($connections,$query);


while ($row = mysqli_fetch_assoc($select_categories)){
    $id = $row['id'];
$doc_id = $row['doctor_id'];
$doc_name = $row['full_name'];
$email = $row['email'];

echo "<tr>";
echo "<td>{$doc_id}</td>";
echo "<td>{$doc_name}</td>";
echo "<td>{$email}</td>";

echo "<td><a onClick=\"javascript:return confirm ('Are you sure you want to Activate Account');\"  href='categories.php?delete={$id}'>Delete</a></td>";
echo "<td><a href='categories.php?edit={$id}'>Edit</a></td>";

echo "</tr>";
}	
}


function deleteCategories(){

global $connections;

if(isset($_GET['delete'])){
$the_cat_id = $_GET['delete'];
$query = "DELETE FROM doctors WHERE id = {$the_cat_id} ";
$delete_query = mysqli_query($connections,$query);
header("Location: categories.php");
}


}




?>