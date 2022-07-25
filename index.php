
<?php include("functions/init.php"); ?>


<?php
$message = "";
if(request_is_post() && request_is_same_domain()) {

if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
$message = "Sorry, request was not valid.";
}
else {
// CSRF tests passed--form was created by us recently.
// retrieve the values submitted via the form
$doc_id               = h($_POST['doc_id']);
$password            = h($_POST['password']);
$remember            = isset($_POST['remember']);

if(empty($doc_id)){
$message="Doctor id cannot be empty";
}
if(empty($password)){
$message="Password cannot be empty";
}
else{
$sql = "SELECT doctor_id, id, password  FROM doctors WHERE doctor_id = '".sql_prep($doc_id)."'";
$result = query($sql);
//if we found somebody
if(row_count($result)== 1){
$row = fetch_array($result);
//$_SESSION['id'] = $row['id'];
//$_SESSION['status'] = $row['status'];
$db_password = $row['password'];
$id = $row['id'];
//password verification   
if($password != $row['password']){
$message="Your Credentials Are Not Correct" ;
}   
//if we are able to find the password
if(password_verify($password, $db_password)){
//redirect to admin page if user is an admin
$_SESSION['id'] = $id;
$_SESSION['doctor_id'] = $doc_id;
redirect('list.php');

//if the remember button is clicked set cookies

//   return true;
}
}else{
$message= "Your Credentials Are Not Correct or ID not registered";
}
}
}       
}
?>




<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Doctor Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Please Login To Enter Your Dashboard </h4>

                </div>

            </div>
             <span style="color:red;" ><?php //echo htmlentities($_SESSION['errmsg']); ?><?php //echo htmlentities($_SESSION['errmsg']="");?></span>
            <form name="admin" method="post">
                            <?php echo csrf_token_tag(); ?>

                                     <?php
      if($message != "") {
 
       echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>' ." ".  h($message) . '</div>';
      }
    ?>
            <div class="row">
                <div class="col-md-6">
                     <label>Enter Dotor ID: </label>
                        <input type="text" name="doc_id" class="form-control" placeholder="Enter Doctor ID" />
                        <label>Enter Password :  </label>
                        <input type="password" name="password" class="form-control"  placeholder="Enter Password" />
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In </button>&nbsp;
                </div>
                </form>
                <div class="col-md-6">
                    <div class="alert alert-info">
                        Welcome to our Doctor(s) login page. 
                    
                        <br />
                         <strong> Some of its features are given below :</strong>
                        <ul>
                            <li>
                                Enter your Doctors ID
                            </li>
                            <li>
                                Enter your password
                            </li>
                            <li>
                                Click on Log Me In to view dashboard
                            </li>
                         
                        </ul>
                       
                    </div>
                                    </div>

            </div>
        </div>
    </div>
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
