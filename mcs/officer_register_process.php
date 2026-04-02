<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost","root","","mcs1");

if(!$conn){
die("Connection Failed: " . mysqli_connect_error());
}

$aadhaar = $_POST['aadhaar'];
$name = $_POST['officerName'];
$middle = $_POST['middleName'];
$surname = $_POST['surname'];
$father = $_POST['fatherName'];
$mother = $_POST['motherName'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$mobile = $_POST['mobileNumber'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if($password != $confirmPassword){
die("Passwords do not match");
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO officer_register 
(aadhaar,officerName,middleName,surname,fatherName,motherName,gender,dob,mobileNumber,password)
VALUES
('$aadhaar','$name','$middle','$surname','$father','$mother','$gender','$dob','$mobile','$hashed_password')";

if(mysqli_query($conn,$sql)){
echo "Officer Registration Successful";
}
else{
echo "Error: " . mysqli_error($conn);
}

?>