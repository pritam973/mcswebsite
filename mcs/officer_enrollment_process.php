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

// ------------------------
// Generate and Download PDF
// ------------------------
require('fpdf/fpdf.php');

$officer_name = $_SESSION['officer_name'];
$officer_id = $_SESSION['officer_id'];

$pdf = new FPDF('P','mm','A4');
$pdf->SetAutoPageBreak(true, 15);
$pdf->AddPage();

// Logo top center
$logoPath = 'logo.jpeg';
if (file_exists($logoPath)) {
    $pdf->Image($logoPath, 85, 10, 40);
}

$pdf->Ln(30);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,10,'MARINE COMMAND SQUAD',0,1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'OFFICER ENROLLMENT FORM',0,1,'C');
$pdf->Ln(5);

// Officer runtime info
$pdf->SetFont('Arial','B',12);
$pdf->Cell(35,8,'Processed by:',0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,"$officer_name (ID: $officer_id)",0,1);
$pdf->Ln(3);

// Officer photo box
if (file_exists($photo) && !empty($photo)) {
    $pdf->Image($photo, 145, 52, 45, 55);
} else {
    $pdf->Rect(145, 50, 45, 55);
    $pdf->SetXY(145, 106);
    $pdf->SetFont('Arial','I',8);
    $pdf->Cell(45,4,'Photo',0,0,'C');
}

$pdf->SetXY(10, 55);

$fields = [
    'Reg No.' => $registration_number,
    'Name' => $name,
    'Address' => $address,
    'Blood Group' => $bloodgroup,
    'Contact No.' => $mobile,
    'Rank' => $rank,
    'DOB' => $dob,
    'Nationality' => $nationality,
    'State' => $state,
    'District' => $district,
    'Gender' => $gender,
    'Police Station' => $police_station,
    'Qualification' => $qualification,
    'Institution' => $institution,
    'ID Mark' => $idmark,
    'Aadhaar' => $aadhaar
];

$pdf->SetFont('Arial','',11);
foreach ($fields as $label => $value) {
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(40,7,$label.':',0,0);
    $pdf->SetFont('Arial','',11);
    $pdf->MultiCell(90,7,$value,0,1);
}

echo "<h2>Officer Enrollment Successful!</h2>";
echo "<p><strong>Registration No:</strong> $registration_number</p>";
echo "<p><strong>Name:</strong> $name</p>";
echo "<p><strong>Mobile:</strong> $mobile</p>";
echo "<p><strong>Blood Group:</strong> $bloodgroup</p>";
echo "<p><a href='officer_enrollment.php'>Submit Another Enrollment</a></p>";

mysqli_close($conn);
exit();