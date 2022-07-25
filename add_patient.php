<?php include("functions/init.php"); ?>


<?php
//Add bed code
$message = "";
if(isset($_POST['add_patient'])){
$bed_number = sql_prep($_POST['bed_number']);
$patient_name = sql_prep($_POST['patient_name']);
$patient_age = sql_prep($_POST['patient_age']);
$symptons = sql_prep($_POST['symptons']);
$gender = sql_prep($_POST['gender']);

$patient_age = dirty_html($patient_age);
$patient_name = dirty_html($patient_name);
$symptons = dirty_html($symptons);
$gender = dirty_html($gender);
$bed_number = dirty_html($bed_number);


$bed_number = h($bed_number);
$patient_name = h($patient_name);
$patient_age = h($patient_age);
$symptons = h($symptons);
$gender = h($gender);


$date = date("F j, Y, g:i a");

if(empty($bed_number)){

 $message = "bed_number cannot be empty";

}

if(empty($patient_name)){
	$message = "patient name cannot be empty";
}

if(empty($patient_age)){
	$message= "patient age cannot be empty";
}

if(empty($symptons)){
	$message= "symptons field cannot be empty";
}
if(empty($gender)){
	$message = "gender field cannot be empty";
}

if(!$message){
$the_doc_id = $_SESSION['id'];
$query_doc_id = "SELECT doctor_id FROM doctors WHERE id = '$the_doc_id'";
$send_query = mysqli_query($connections,$query_doc_id);
$row = mysqli_fetch_array($send_query);
$doctor_id = $row['doctor_id'];

$sql = "INSERT INTO patients(patient_name,age,gender,symptons,bed_number,doctor_id,date)";
$sql.="VALUES('$patient_name','$patient_age','$gender','$symptons','$bed_number','$doctor_id','$date')";
$query_add_patient = mysqli_query($connections,$sql);
if(!$query_add_patient){
		
		die("QUERY FAILED" . mysqli_error($connections));
	}

if($query_add_patient){
	echo '<script>alert("Data Saved");</script>';
	header('Location:list.php');
	$display_message = "<p class='alert alert-success text-center ' role='alert' >Patient Added Successfully</p>";
$_SESSION['display_message'] = $display_message;
}
else{
	echo '<script>alert("Data not Saved"); </script>';
}
}



}

?>


