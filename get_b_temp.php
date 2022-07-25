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

 //$body_temp= $row['body_temp'];


 $body_temp=str_openssl_dec($row['body_temp'],$iv);

               
echo $body_temp."°";


 ?>