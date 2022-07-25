<?php
include('db.php');

function str_openssl_dec($str,$iv){
	$key='1234567890vishal%$%^%$$#$#';
	$chiper="AES-128-CTR";
	$options=0;
	$str=openssl_decrypt($str,$chiper,$key,$options,$iv);
	return $str;
}

$res=mysqli_query($con,"select * from form order by id desc");

echo "<table border='1'>";
	echo "<tr><td>Id</td><td>Name</td><td>Email</td></tr>";
	while($row=mysqli_fetch_assoc($res)){
		$iv=hex2bin($row['iv']);
		$name=str_openssl_dec($row['name'],$iv);
		$email=str_openssl_dec($row['email'],$iv);
		
		
		echo "<tr><td>".$row['id']."</td><td>".$name."</td><td>".$email."</td></tr>";
	}
echo "</table>"



	$iv=openssl_random_pseudo_bytes(16);
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	
	$name=str_openssl_enc($name,$iv);
	$email=str_openssl_enc($email,$iv);
	
	$iv=bin2hex($iv);
	
	$id=mysqli_query($con,"insert into form(name,email,iv) values('$name','$email','$iv')");
	if($id>0){
		echo "Thank you for providing information";
	}else{
		echo "Please try after sometime";
	}









?>




