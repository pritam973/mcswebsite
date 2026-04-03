<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost","root","","mcs1");

if(!$conn){
die("Connection Failed: " . mysqli_connect_error());
}

$aadhaar = $_POST['aadhaar'];
$name = $_POST['cadetName'];
$middle = $_POST['middleName'];
$surname = $_POST['surname'];
$father = $_POST['fatherName'];
$mother = $_POST['motherName'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO student_register 
(aadhaar,cadetName,middleName,surname,fatherName,motherName,gender,dob,mobile,password)
VALUES
('$aadhaar','$name','$middle','$surname','$father','$mother','$gender','$dob','$mobile','$hashed_password')";

if(mysqli_query($conn,$sql)){
echo "Registration Successful";
}
else{
echo "Error: " . mysqli_error($conn);
}

?>