<?php
session_start();

$conn = mysqli_connect("localhost","root","","mcs1");

$mobile = $_POST['mobileNumber'];
$password = $_POST['password'];

$sql = "SELECT * FROM officer_register WHERE mobileNumber='$mobile'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==1){

$row = mysqli_fetch_assoc($result);

if(password_verify($password,$row['password'])){

$_SESSION['officer_id'] = $row['id'];
$_SESSION['officer_name'] = $row['officerName'];

header("Location: officer_dashboard.php");
exit();

}
else{
echo "Incorrect Password";
}

}
else{
echo "Officer not registered";
}
?>