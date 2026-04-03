<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

/* DATABASE CONNECTION */

$conn = mysqli_connect("localhost","root","","mcs1");

if(!$conn){
die("Database connection failed: " . mysqli_connect_error());
}

/* TEXT FIELDS */

$officer_id = $_POST['officer_id'] ?? '';
$name = $_POST['name'] ?? '';
$rank = $_POST['rank'] ?? '';
$registration_number = $_POST['registration_number'] ?? '';
$dob = $_POST['dob'] ?? '';
$nationality = $_POST['nationality'] ?? '';
$address = $_POST['address'] ?? '';
$state = $_POST['state'] ?? '';
$district = $_POST['district'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$bloodgroup = $_POST['bloodgroup'] ?? '';
$gender = $_POST['gender'] ?? '';
$police_station = $_POST['police'] ?? '';   // FIXED
$qualification = $_POST['qualification'] ?? '';
$institution = $_POST['institution'] ?? '';
$idmark = $_POST['idmark'] ?? '';
$aadhaar = $_POST['aadhaar'] ?? '';

/* FILE UPLOAD DIRECTORY */

$upload_dir = "uploads/";

if(!is_dir($upload_dir)){
mkdir($upload_dir,0777,true);
}

/* FUNCTION FOR SAFE FILE UPLOAD */

function uploadFile($fileInput,$upload_dir){

if(!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['error']!=0){
return '';
}

$filename = time().'_'.basename($_FILES[$fileInput]['name']);
$target = $upload_dir.$filename;

if(move_uploaded_file($_FILES[$fileInput]['tmp_name'],$target)){
return $target;
}
else{
return '';
}

}

/* FILE UPLOADS */

$aadhaarCard = uploadFile("aadhaarCard",$upload_dir);
$bankPassbook = uploadFile("bankPassbook",$upload_dir);
$birthCert = uploadFile("birthCert",$upload_dir);
$institutionCert = uploadFile("institutionCert",$upload_dir);
$declaration = uploadFile("declaration",$upload_dir);
$medicalCert = uploadFile("medicalCert",$upload_dir);
$photo = uploadFile("photo",$upload_dir);
$signature = uploadFile("signature",$upload_dir);

/* INSERT INTO DATABASE */

$sql = "INSERT INTO officer_enrollment
(officer_id,name,rank,registration_number,dob,nationality,address,state,district,mobile,bloodgroup,gender,police_station,qualification,institution,idmark,aadhaar,aadhaarCard,bankPassbook,birthCert,institutionCert,declaration,medicalCert,photo,signature)

VALUES
('$officer_id','$name','$rank','$registration_number','$dob','$nationality','$address','$state','$district','$mobile','$bloodgroup','$gender','$police_station','$qualification','$institution','$idmark','$aadhaar','$aadhaarCard','$bankPassbook','$birthCert','$institutionCert','$declaration','$medicalCert','$photo','$signature')";

if(mysqli_query($conn,$sql)){
echo "Enrollment Submitted Successfully";
}
else{
echo "SQL Error: ".mysqli_error($conn);
}

?>