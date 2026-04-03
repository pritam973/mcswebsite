<?php
if(!file_exists(__DIR__ . '/fpdf/fpdf.php')){
    die("FPDF file missing");
    }
error_reporting(E_ALL);
ini_set('display_errors',1);

$conn = mysqli_connect("localhost","root","","mcs1");

if(!$conn){
die("Connection Failed");
}

/* GET DATA */

$name = $_POST['name'] ?? '';
$father = $_POST['father'] ?? '';
$mother = $_POST['mother'] ?? '';
$dob = $_POST['dob'] ?? '';
$nationality = $_POST['nationality'] ?? '';
$address = $_POST['address'] ?? '';
$state = $_POST['state'] ?? '';
$district = $_POST['district'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$bloodgroup = $_POST['bloodgroup'] ?? '';
$gender = $_POST['gender'] ?? '';
$police = $_POST['police'] ?? '';
$qualification = $_POST['qualification'] ?? '';
$school = $_POST['school'] ?? '';
$idmark = $_POST['idmark'] ?? '';
$aadhaar = $_POST['aadhaar'] ?? '';

/* ======================
   GENERATE CADET ID
====================== */

$year = date("Y");

$genderCode = ($gender=="Male") ? "SD" : "SW";

$prefix = "WB".$year.$genderCode."MCS777";

$query = "SELECT cadet_id FROM cadet_enrollment 
WHERE cadet_id LIKE '$prefix%' 
ORDER BY cadet_id DESC LIMIT 1";

$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0){
$row = mysqli_fetch_assoc($result);
$last = substr($row['cadet_id'],-3);
$num = intval($last)+1;
}else{
$num = 1;
}

$num = str_pad($num,3,"0",STR_PAD_LEFT);

$cadet_id = $prefix.$num;

/* ======================
   FILE UPLOAD
====================== */

/* ======================
   FILE UPLOAD (ALL FILES)
====================== */

$upload_dir = "uploads/";

if(!is_dir($upload_dir)){
mkdir($upload_dir,0777,true);
}

function uploadFile($input,$upload_dir){

if(!isset($_FILES[$input]) || $_FILES[$input]['error']!=0){
return "";
}

$filename = time().'_'.basename($_FILES[$input]['name']);
$target = $upload_dir.$filename;

move_uploaded_file($_FILES[$input]['tmp_name'],$target);

return $target;
}

/* ALL FILES */

$aadhaarCard = uploadFile("aadhaarCard",$upload_dir);
$bankPassbook = uploadFile("bankPassbook",$upload_dir);
$birthCert = uploadFile("birthCert",$upload_dir);
$marksheet = uploadFile("marksheet",$upload_dir);
$bondPaper = uploadFile("bondPaper",$upload_dir);
$declaration = uploadFile("declaration",$upload_dir);
$medicalCert = uploadFile("medicalCert",$upload_dir);
$photo = uploadFile("photo",$upload_dir);
$signature = uploadFile("signature",$upload_dir);

/* ======================
   INSERT DATABASE
====================== */

$sql = "INSERT INTO cadet_enrollment
(cadet_id,name,father,mother,dob,nationality,address,state,district,mobile,bloodgroup,gender,police,qualification,school,idmark,aadhaar,photo)

VALUES
('$cadet_id','$name','$father','$mother','$dob','$nationality','$address','$state','$district','$mobile','$bloodgroup','$gender','$police','$qualification','$school','$idmark','$aadhaar','$photo')";

mysqli_query($conn,$sql);

/* ======================
   GENERATE PDF
====================== */


?>