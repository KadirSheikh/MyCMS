<?php 

//my data functions

function getUserPost(){
    global $conn;
    $post = mysqli_query($conn , "SELECT * FROM posts WHERE user_id = ".returnUserAjax()."");
    return mysqli_num_rows($post);
}
function getUserComment(){
    global $conn;
    $post = mysqli_query($conn , "SELECT * FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id WHERE posts.user_id = ".returnUserAjax()."");
    return mysqli_num_rows($post);
}
function getUserCatagory(){
    global $conn;
    $post = mysqli_query($conn , "SELECT * FROM catogery WHERE user_id = ".returnUserAjax()."");
    return mysqli_num_rows($post);
}

function escape($string){
global $conn;
return mysqli_real_escape_string($conn , trim(strip_tags($string)));

}

function redirect($location){
global $conn;
header("Location:".$location);
exit;
}

function ifIsMethod($method=null){
if($_SERVER['REQUEST_METHOD'] == $method){
return true;
}
return false;
}

function ifLoggedIn(){
if(isset($_SESSION['user_name'])){
return true;
}
return false;
}

function isAdmin(){
    global $conn;
if(ifLoggedIn()){
$user_id = $_SESSION['user_id'];
$exe = mysqli_query($conn , "SELECT user_role FROM users WHERE user_id ={$user_id}");
$row = mysqli_fetch_assoc($exe);
if($row['user_role'] == 'admin'){
return true;

}else{
  return false;  
}

}
}

function returnUserAjax(){
global $conn;
if(ifLoggedIn()){

$user = $_SESSION['user_name'];
$query = "SELECT * FROM users WHERE user_name ='{$user}'";
$exe = mysqli_query($conn , $query);
$row = mysqli_fetch_assoc($exe);
if(mysqli_num_rows($exe) >= 1){
return $row['user_id'];
}
return false;
}

}

function totalLikes($post_id = ''){
global $conn;
$select  = mysqli_query($conn , "SELECT * FROM posts WHERE post_id = {$post_id}");
$row = mysqli_fetch_assoc($select);
return $row['likes'];

}

function userLikePostOrNot($postid = ''){
global $conn;

$query = "SELECT * FROM `likes` WHERE  post_id = $postid AND  user_id =".returnUserAjax()."";
$exe = mysqli_query($conn , $query);

return mysqli_num_rows($exe) >= 1 ? true : false;

}

function checkIfUserIsLoggedInAndRedirctTo($redirectLocation){
if(ifLoggedin()){
redirect($redirectLocation);
}
}


function users_online() {

if(isset($_GET['onlineusers'])){
global $conn;
if(!$conn){
session_start();
include("../includes/connect.php");

$session = session_id();
$time = time();
$time_out_in_seconds = 05;
$time_out = $time - $time_out_in_seconds;

$query = "SELECT * FROM user_online WHERE session = '$session'";
$send_query = mysqli_query($conn, $query);
$count = mysqli_num_rows($send_query);

if($count == NULL) {

mysqli_query($conn, "INSERT INTO user_online(session, time) VALUES('$session','$time')");


} else {

mysqli_query($conn, "UPDATE user_online SET time = '$time' WHERE session = '$session'");


}

$users_online_query =  mysqli_query($conn, "SELECT * FROM user_online WHERE time > '$time_out'");
echo $count_user = mysqli_num_rows($users_online_query);

}


}

}
users_online();



function insertcatagory(){
global $conn;

if (isset($_POST['add'])) {
$user_id = $_SESSION['user_id']; 
$cat_title = $_POST['title'];

if ($cat_title == "") {
echo "Field is empty";
}
else{
$stmt = mysqli_prepare($conn , "INSERT INTO catogery(user_id , cat_title) VALUES (?,?)");
mysqli_stmt_bind_param($stmt , 'is' , $user_id,$cat_title);
mysqli_stmt_execute($stmt);
if ($stmt) {
echo "Catagory added successfully";
}
else{
die('Failed'.mysqli_error($conn));
}
}
}

}




function display(){
global $conn;
$query = "SELECT * FROM catogery";
$data = mysqli_query($conn , $query);

while ($row = mysqli_fetch_assoc($data)) 
{
$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];


echo "<tr>";
echo "<td>$cat_id</td>";
echo "<td>$cat_title</td>";
echo "<td><a href='addcatagory.php?delete=$cat_id' class='btn btn-danger' title='Delete'>Delete</a></td>";
echo "<td><a href='addcatagory.php?edit=$cat_id' class='btn btn-primary' title='Edit or Update'>Edit</a></td>";
echo "</tr>";
}
}


function delete(){
global $conn;
if(isset($_GET['delete'])){
$id_cat = $_GET['delete'];
$query = "DELETE FROM catogery WHERE cat_id = {$id_cat}";

$delete = mysqli_query($conn , $query);
header("Location:addcatagory.php");
}  


}

//code of index

function select_from($table){
global $conn;
$query = "SELECT * FROM " . $table;
$data = mysqli_query($conn , $query);
$count = mysqli_num_rows($data);
return $count;


}


function status_result($table , $col , $status){
global $conn;
$query = "SELECT * FROM $table WHERE $col = '$status'";
$data = mysqli_query($conn , $query);
$count =  mysqli_num_rows($data);
return $count;
}


function role_result($table , $col , $role){
global $conn;
$query = "SELECT * FROM $table WHERE $col = '$role'";
$data = mysqli_query($conn , $query);
$count =  mysqli_num_rows($data);
return $count;
}


function duplicate_user($username){
global $conn;
$query = "SELECT user_name FROM users WHERE user_name = '$username'";
$data = mysqli_query($conn , $query);

if(mysqli_num_rows($data)>0){
return true;
}else{
return false;
}
}

function duplicate_email($email){
global $conn;
$query = "SELECT user_email FROM users WHERE user_email = '$email'";
$data = mysqli_query($conn , $query);

if(mysqli_num_rows($data)>0){
return true;
}else{
return false;
}
}

function register($username,$firstname,$lastname,$email,$password){
global $conn;


$username = mysqli_real_escape_string($conn , $username);
$firstname = mysqli_real_escape_string($conn , $firstname);
$lastname = mysqli_real_escape_string($conn , $lastname);
$email = mysqli_real_escape_string($conn , $email);
$password = mysqli_real_escape_string($conn , $password);
$password = password_hash($password , PASSWORD_BCRYPT , array('cost' => 12));


$insert_query = "INSERT INTO `users`(`user_name`, `user_firstname`, `user_lastname` , `user_email`, `user_password`, `user_role`) VALUES ('{$username}','{$firstname}','{$lastname}', '{$email}','{$password}','subscriber')";

$insert_data = mysqli_query($conn , $insert_query);
if(!$insert_data){
die(mysqli_error($conn));
}
}



function login($username,$password){
global $conn;
$username = trim($username);
$password = trim($password);
$username = mysqli_real_escape_string($conn , $username);
$password = mysqli_real_escape_string($conn , $password);

$query = "SELECT * FROM users WHERE user_name = '{$username}'";
$select_query = mysqli_query($conn , $query);

while ($row = mysqli_fetch_assoc($select_query)){
$db_user_id = $row['user_id'];
$db_user_name = $row['user_name'];
$db_user_password = $row['user_password'];
$db_user_role = $row['user_role'];
$db_user_firstname = $row['user_firstname'];
$db_user_lastname = $row['user_lastname'];
/*$password = crypt($password , $db_user_password);*/
if(/*$username == $db_user_name && $password == $db_user_password*/password_verify($password , $db_user_password)){

$_SESSION['user_name'] = $db_user_name;
$_SESSION['user_firstname'] = $db_user_firstname;
$_SESSION['user_lastname'] = $db_user_lastname;
$_SESSION['user_role'] = $db_user_role;
redirect("/cms/admin");

}else{
return false;
}
return true;
}

}







?>