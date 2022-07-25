<?php include("functions/init.php"); ?>
<?php  include "modals.php" ?>
<?php 
error_reporting(0);
header("Refresh:25");
if (!isset($_SESSION['doctor_id']) && (!isset($_SESSION['id']))) {
  header("Location: index.php");
  exit(0);
}


function str_openssl_dec($str,$iv){
$key='1234567890vishal%$%^%$$#$#';
$chiper="AES-128-CTR";
$options=0;
$str=openssl_decrypt($str,$chiper,$key,$options,$iv);
return $str;
}

$sqlQuery = "SELECT heart_beat,iv,date_created FROM status ORDER by id DESC LIMIT 1";
$result =mysqli_query($connections,$sqlQuery);
$row = mysqli_fetch_array($result);
$iv = hex2bin($row['iv']);
$heart_beat=str_openssl_dec($row['heart_beat'],$iv);
$h_date = $row['date_created'];

$sqlQuery1 = "SELECT body_temp,iv,date_created FROM status ORDER by id DESC LIMIT 1";
$result =mysqli_query($connections,$sqlQuery1);
$row = mysqli_fetch_array($result);
$iv = hex2bin($row['iv']);
$body_temp =str_openssl_dec($row['body_temp'],$iv);
$b_date = $row['date_created'];

$sqlQuery2 = "SELECT room_humidity,iv,date_created FROM status ORDER by id DESC LIMIT 1";
$result =mysqli_query($connections,$sqlQuery2);
$row = mysqli_fetch_array($result);
$iv = hex2bin($row['iv']);
$room_humidity =str_openssl_dec($row['room_humidity'],$iv);
$rh_date = $row['date_created'];


$sqlQuery3 = "SELECT room_temperature,iv,date_created FROM status ORDER by id DESC LIMIT 1";
$result =mysqli_query($connections,$sqlQuery3);
$row = mysqli_fetch_array($result);
$iv = hex2bin($row['iv']);
$room_temperature =str_openssl_dec($row['room_temperature'],$iv);
$rt_date = $row['date_created'];


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
<h1 class="page-head-line">Patient Details</h1>
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
if(isset($_GET['pid'])) {
$killa = $_GET['pid'];
$terminator = mysqli_query($connections,"SELECT * FROM patients WHERE id ='$killa'");
$row = mysqli_fetch_array($terminator);
$patient_name = $row['patient_name'];
$age = $row['age'];
$gender = $row['gender'];
$symptons = $row['symptons'];
$bed_number = $row['bed_number'];
?>




<div class="col-md-12 ">
   <div class="col-md-4"></div>
  <div class="col-md-4">
    
<span class="" style="padding: 0; margin: 0; font-size: 20px; font-family: time;"><b>Patient name:</b> <?php echo $patient_name ?></span> <br>
<span class="" style="padding: 0; margin: 0; font-size: 20px; font-family: time;"><b>Gender:</b> <?php echo $gender; ?></span> <br>
<span class="" style="padding: 0; margin: 0; font-size: 20px; font-family: time;"><b>Age:</b> <?php echo $age; ?></span> <br><br>

</div>
<div class="col-md-4">

    
    
<span class="" style="padding: 0; margin: 0; font-size: 20px; font-family: time;"><b>Symptons:</b> <?php echo $symptons; ?></span> <br>


</div>
</div>
<div class="row" >

<!-- <div class="col-md-4"></div>
 -->

<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading">
  <center><b>Body Temperature</b></center>
</div>
<font color="red" align="center"><?php// echo htmlentities($_SESSION['msg']);?><?php //echo htmlentities($_SESSION['msg']="");?></font>
<div class="panel-body">
<center>
    <span id="get_b_temp" style="font-size: 50px; font-family: time;">0°</span><span><br>degrees</span>
</center>

<hr />
<center><?= $b_date;?></center>
</div>
</div>
</div>

<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading">
    <center><b>Pulse Rate</b></center>
</div>
<font color="red" align="center"></font>
<div class="panel-body">
<center><span id="get_b_bpm" style="font-size: 50px; font-family: time;">0</span><span><br>bpm</span></center>
<hr />
<center><?= $h_date;?></center>
</div>
</div>
</div>


<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading">
<center><b>Room Temperature</b></center>
</div>
<font color="red" align="center"><?php// echo htmlentities($_SESSION['msg']);?><?php //echo htmlentities($_SESSION['msg']="");?></font>
<div class="panel-body">
<center><span id="get_r_temp" style="font-size: 50px; font-family: time;">0°</span><span><br>degrees</span></center>
<hr />
<center><?= $rh_date;?></center>
</div>
</div>
</div>


<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading">
  <center><b>Room Humidity</b></center>
</div>
<font color="red" align="center"><?php// echo htmlentities($_SESSION['msg']);?><?php //echo htmlentities($_SESSION['msg']="");?></font>
<div class="panel-body">
<center><span id="get_h_temp" style="font-size: 50px; font-family: time;">0</span><span style="font-size: 20px;"><br>%</span></center>

<hr />
<center><?= $rt_date;?></center>
</div>
</div>
</div>

</div>
<?php 

  // heart beat data
if($heart_beat >= 121){

$txt= "$patient_name Symptons is $symptons , The current heart beat rate is $heart_beat which is high ,March attention is need urgently.Thank you";
$txt=rawurlencode($txt);
$html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-US');
$player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
echo $player;
//unset($_SESSION['heart_beat']);
}

   // Body Temperature
elseif($body_temp >= 37){

$txt= "$patient_name Symptons is $symptons , The current Body Temperature  is $body_temp °C ,$patient_name needs urgent attention";
$txt=rawurlencode($txt);
$html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-US');
$player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
echo $player;

}
elseif($room_humiidty >= 80 ){

    $txt= "The room humidity is $room_humidity °C";
$txt=rawurlencode($txt);
$html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-US');
$player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
echo $player;

} 
elseif($room_temperature >= 40){

$txt= "The room Temperature is $room_temperature °C";
$txt=rawurlencode($txt);
$html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-US');
$player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
echo $player;
}

// esle{}
?>

</div>
</div>
</div>
</div>

<!-- <div id="show_data"></div> -->

<?php } ?>


  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>

<script type="text/javascript">
// var auto_refresh = setInterval(
// function ()
// {
// $('#get_b_temp').load('get_b_temp.php').fadeIn("slow");
// }, 10000); // refresh every 10000 milliseconds
</script>
<script type="text/javascript">
    $(document).ready(function(){
    setInterval(function(){
    $('#show_data').load('data.php').fadeIn("slow");

    }, 100);
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
    setInterval(function(){
    $('#get_b_temp').load('get_b_temp.php').fadeIn("slow");

    }, 100);
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
    setInterval(function(){
    $('#get_b_bpm').load('get_b_bpm.php').fadeIn("slow");

    }, 100);
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
    setInterval(function(){
    $('#get_r_temp').load('get_r_temp.php').fadeIn("slow");

    }, 100);
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
    setInterval(function(){
    $('#get_h_temp').load('get_h_temp.php').fadeIn("slow");

    }, 100);
    });
</script>


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

