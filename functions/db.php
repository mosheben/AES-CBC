<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "zerkproject";

foreach ($db as $key => $values){
define(strtoupper($key) , $values);

}

$connections = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

?>