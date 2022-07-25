<?php include("functions/init.php"); 
//error_reporting(0);
header("Refresh:1");
?>

<?php
function str_openssl_enc($str,$iv){
	$key='1234567890vishal%$%^%$$#$#';
	$chiper="AES-128-CTR";
	$options=0;
	$str=openssl_encrypt($str,$chiper,$key,$options,$iv);
	return $str;
}

$iv1=openssl_random_pseudo_bytes(16);
 $bed_id =  rand(23,290);

$body_temp = rand(35,37);
$heart_beat = rand(60,160);
$room_temperature = rand(34,40);
$room_humidity = rand(50,80); 

$file = fopen("data.txt","r");
while(!feof($file)){
	$content = fgets($file);
	$array = explode(",",$content);
	list($body_temp1,$heart_beat1,$room_temperature1,$room_humidity1) = $array;

$bed_id =str_openssl_enc($bed_id,$iv);
$body_temp =str_openssl_enc($body_temp1,$iv1);
$heart_beat =str_openssl_enc($heart_beat1,$iv1);
$room_temperature =str_openssl_enc($room_temperature1,$iv1);
$room_humidity =str_openssl_enc($room_humidity1,$iv1);

$iv=bin2hex($iv1);

$sql = "INSERT INTO status (bed_number,body_temp,heart_beat,date_created,room_temperature,room_humidity,iv) VALUES ( '$bed_id' , '$body_temp', '$heart_beat', CURRENT_TIMESTAMP,'$room_temperature','$room_humidity','$iv')"; 
(mysqli_query($connections, $sql));
}

// $sql = "INSERT INTO status (bed_number,body_temp,heart_beat,date_created,room_temperature,room_humidity,iv) VALUES ( '$bed_id' , '$body_temp1', '$heart_beat1', CURRENT_TIMESTAMP,'$room_temperature1','$room_humidity1','$iv')"; 
// (mysqli_query($connections, $sql));






