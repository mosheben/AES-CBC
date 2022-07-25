<?php   
//===== DATABASE HELPER FUNCTIONS =====//
function redirect($location){
    header("Location:" . $location);
    exit;
}

function query($query){
    global $connections;
    $result = mysqli_query($connections, $query);
    confirmQuery($result);
    return $result;
}

function fetchRecords($result){
    return mysqli_fetch_array($result);
}

function count_records($result){
    return mysqli_num_rows($result);
}
//===== END DATABASE HELPERS =====//










function ConfirmQuery($result){
global $connections;

if(!$result)
{
die("QUERY FAILED " .mysqli_error($connections));	

}
}



function insert_categories()

{
global $connections;
$message = "";
if(isset($_POST['submit']))
{

$doc_name = $_POST['doc_name'];
$email = $_POST['email'];

if(empty($doc_name)){
$message = "Doctor name field should not be empty ";
}

if(empty($email)){
$message = "Email field should not be empty ";
}

if(!$message)
{
    $doc_id =  substr(number_format(time() * rand(),0,'',''),0,6);
    $doc_password = $doc_id;
    $hash_password = password_hash($doc_password,PASSWORD_BCRYPT, array('cost'=>12));
$query = "INSERT INTO doctors(doctor_id,full_name,email,password) ";
$query .= "VALUES('{$doc_id}','{$doc_name}','{$email}','{$hash_password}') ";	
$create_category_query = mysqli_query($connections,$query);
if(!$create_category_query){
die('QUERY FAILED' . mysqli_error($connections));
}
else{
echo "<span class='text-info'> Doctor Added </span>";	
}
}

}

echo "<span class='text-danger'>".$message."</span>";
}



function findAllCategories() {

global $connections;

$query = "SELECT * FROM doctors ";
$select_categories = mysqli_query($connections,$query);


while ($row = mysqli_fetch_assoc($select_categories)){
    $id = $row['id'];
$doc_id = $row['doctor_id'];
$doc_name = $row['full_name'];
$email = $row['email'];

echo "<tr>";
echo "<td>{$doc_id}</td>";
echo "<td>{$doc_name}</td>";
echo "<td>{$email}</td>";

echo "<td><a href='categories.php?delete={$id}'>Delete</a></td>";
echo "<td><a href='categories.php?edit={$id}'>Edit</a></td>";

echo "</tr>";
}	
}


function deleteCategories(){

global $connections;

if(isset($_GET['delete'])){
$the_cat_id = $_GET['delete'];
$query = "DELETE FROM doctors WHERE id = {$the_cat_id} ";
$delete_query = mysqli_query($connections,$query);
header("Location: categories.php");
}


}





?>