<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$conn = mysqli_connect("localhost","root","","mcs1");

if(!$conn){
die("Database Connection Failed");
}

$mobile = $_POST['mobnumber'];
$password = $_POST['password'];

$sql = "SELECT * FROM student_register WHERE mobile='$mobile'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==1){

$row = mysqli_fetch_assoc($result);

if(password_verify($password,$row['password'])){

$_SESSION['cadet_name'] = $row['cadetName'];
$_SESSION['cadet_id'] = $row['id'];

header("Location: cadet_dashboard.php");

}else{

echo "Incorrect Password";

}

}else{

echo "Cadet Not Registered";

}

?>