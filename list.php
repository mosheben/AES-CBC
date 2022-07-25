<?php include("functions/init.php"); ?>
<?php  include "modals.php" ?>

<?php 
error_reporting(0);
header("Refresh:14");
if (!isset($_SESSION['doctor_id']) && (!isset($_SESSION['id']))) {
  header("Location: index.php");
  exit(0);
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Patients</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php 
 include('includes/menubar.php');

 ?>
    <!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row">
<div class="col-md-12 ">
<h1 class="page-head-line">My Patients</h1>
 <center >
    
    <?php 
         
         if(isset($_SESSION['display_message'])){
             echo $_SESSION['display_message']; 
             unset($_SESSION['display_message']);
         }
      
       ?>


</center>
</div>

 <?php 

$select_patient = mysqli_query($connections,"SELECT * FROM doctors WHERE doctor_id = '".$_SESSION['doctor_id']."'");
$row = mysqli_fetch_array($select_patient);
$dr_name = $row['full_name'];

$num = "45";
    $txt= "Hello  $dr_name, below are your patient(s). To view your patient health status. Click on the view details button on a particular patient.click on the delete button to delete patient.";
    $txt=rawurlencode($txt);
    $html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-US');
    $player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
    echo $player;


 ?>
<div class="row" >

<?php  
$select_patient = mysqli_query($connections,"SELECT * FROM patients WHERE doctor_id = '".$_SESSION['doctor_id']."'");
while ($row = mysqli_fetch_array($select_patient)) {
    $id = $row['id'];
    $patient_name = $row['patient_name'];
    $gender = $row['gender'];
    $symptons = $row['symptons'];
    $bed_number = $row['bed_number'];

    ?>


<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading">
<?php echo "<span class='text-center'><center>$patient_name</center></span>" ?>
</div>
<font color="red" align="center"><?php// echo htmlentities($_SESSION['msg']);?><?php //echo htmlentities($_SESSION['msg']="");?></font>


<div class="panel-body">
<div class="form-group">
    <?php 
if ($gender=="male"){?>
<center><img src="images/male.png" alt="h"></center>
<?php
}else{?>

 <center><img src="images/female.png" alt="h"></center>
  <?php 
}
    ?>
<span><center><?= $gender;?></center></span>
</div>
<a href="details.php?pid=<?php echo $id ?>" class="btn btn-default">View details</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?php echo "<a rel='$id' href='javascript:void(0)' class='btn btn-danger delete_link'><img src='images/delete.png'>Delete</a>"; ?>
<hr />

</div>

</div>
</div>
<?php }?>

</div>

</div>
</div>
</div>
</div>
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>

     <script>  
 $(document).ready(function(){  
      // $('#edit').click(function(){  
      //      $('#insert').val("Insert");  
      //      $('#insert_form')[0].reset();  
      // });  
      $(document).on('click', '#edit_me', function(){ 
                 var id = $(this).attr("value"); 
           $.ajax({  
                url:"fetch_edit.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
                     $('#profile_name').val(data.full_name);  
                     $('#profile_email').val(data.email);  
                     
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
       
 });  
 </script>
 

</body>
</html>

