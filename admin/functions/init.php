<?php ob_start(); //for redirection

session_start();

include("db.php");
require_once("validation_functions.php");
require_once("xss_sanitize_functions.php");
require_once("sqli_escape_functions.php");
require_once("csrf_request_type_functions.php");
require_once("csrf_token_functions.php");
require_once("request_forgery_functions.php");
?>




