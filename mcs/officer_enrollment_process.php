<?php

require_once 'config.php';
session_start();

if(!isset($_SESSION['officer_id'])){
    header("Location: officer_login.html");
    exit();
}

// Collect form data safely
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
$police_station = $_POST['police'] ?? '';
$qualification = $_POST['qualification'] ?? '';
$institution = $_POST['institution'] ?? '';
$idmark = $_POST['idmark'] ?? '';
$aadhaar = $_POST['aadhaar'] ?? '';

// Upload directory
$upload_dir = "uploads/";
if(!is_dir($upload_dir)) mkdir($upload_dir,0777,true);

// Function to safely upload files
function uploadFile($fileInput, $upload_dir){
    if(!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['error'] != 0) return '';
    $filename = time().'_'.basename($_FILES[$fileInput]['name']);
    $target = $upload_dir.$filename;
    if(move_uploaded_file($_FILES[$fileInput]['tmp_name'],$target)) return $target;
    return '';
}

// Upload files
$aadhaarCard = uploadFile("aadhaarCard",$upload_dir);
$bankPassbook = uploadFile("bankPassbook",$upload_dir);
$birthCert = uploadFile("birthCert",$upload_dir);
$institutionCert = uploadFile("institutionCert",$upload_dir);
$declaration = uploadFile("declaration",$upload_dir);
$medicalCert = uploadFile("medicalCert",$upload_dir);
$photo = uploadFile("photo",$upload_dir);
$signature = uploadFile("signature",$upload_dir);

// Insert into database using prepared statement
$stmt = $conn->prepare("INSERT INTO officer_enrollment
(officer_id,name,rank,registration_number,dob,nationality,address,state,district,mobile,bloodgroup,gender,police_station,qualification,institution,idmark,aadhaar,aadhaarCard,bankPassbook,birthCert,institutionCert,declaration,medicalCert,photo,signature)
VALUES
(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("sssssssssssssssssssssss",
    $officer_id, $name, $rank, $registration_number, $dob, $nationality, $address, $state, $district, $mobile, $bloodgroup, $gender, $police_station, $qualification, $institution, $idmark, $aadhaar, $aadhaarCard, $bankPassbook, $birthCert, $institutionCert, $declaration, $medicalCert, $photo, $signature
);

if (!$stmt->execute()) {
    die("SQL Error: " . $stmt->error);
}

$stmt->close();

// Generate PDF
require('fpdf/fpdf.php');
$officer_name = $_SESSION['officer_name'];
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Officer Enrollment Form',0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,"Processed by Officer: $officer_name (ID: $officer_id)",0,1);
$pdf->Ln(3);

// Add form details
$fields = [
    'Full Name' => $name,
    'Rank' => $rank,
    'Registration No' => $registration_number,
    'Date of Birth' => $dob,
    'Nationality' => $nationality,
    'Address' => $address,
    'State' => $state,
    'District' => $district,
    'Mobile' => $mobile,
    'Blood Group' => $bloodgroup,
    'Gender' => $gender,
    'Police Station' => $police_station,
    'Qualification' => $qualification,
    'Institution' => $institution,
    'Identification Mark' => $idmark,
    'Aadhaar No' => $aadhaar
];

foreach($fields as $label => $value){
    $pdf->Cell(50,8,$label.':',0,0);
    $pdf->MultiCell(0,8,$value);
}

// Output PDF to browser
$pdf->Output('I', 'Officer_Enrollment_'.$name.'.pdf');

?>