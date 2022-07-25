 <?php include("functions/init.php"); ?>

 <?php

 function str_openssl_dec($str,$iv){
    $key='1234567890vishal%$%^%$$#$#';
    $chiper="AES-128-CTR";
    $options=0;
    $str=openssl_decrypt($str,$chiper,$key,$options,$iv);
    return $str;
}

$sqlQuery = "SELECT room_temperature,iv FROM status ORDER by id DESC LIMIT 1";

$result =mysqli_query($connections,$sqlQuery);
$row = mysqli_fetch_array($result);

$iv = hex2bin($row['iv']);

 //$room_temperature = $row['room_temperature'];

 $room_temperature =str_openssl_dec($row['room_temperature'],$iv);
               
echo $room_temperature."°";


 ?>