 <?php include("functions/init.php"); ?>
 <?php

function str_openssl_dec($str,$iv){
    $key='1234567890vishal%$%^%$$#$#';
    $chiper="AES-128-CTR";
    $options=0;
    $str=openssl_decrypt($str,$chiper,$key,$options,$iv);
    return $str;
}

$sqlQuery = "SELECT * FROM status ORDER by id DESC LIMIT 1";
$result =mysqli_query($connections,$sqlQuery);
$row = mysqli_fetch_array($result);

$iv = hex2bin($row['iv']);

 $heart_beat=str_openssl_dec($row['heart_beat'],$iv);

 $date_created = $row['date_created'];
           
 echo $heart_beat;


 ?>