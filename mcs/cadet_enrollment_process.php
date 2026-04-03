<?php
require_once 'config.php';
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: cadet_enrollment.php");
    exit();
}

if(!isset($_SESSION['cadet_id'])){
    header("Location: cadet_login.html");
    exit();
}

// Form Data
$cadet_name      = trim($_POST['name'] ?? '');
$father          = trim($_POST['father'] ?? '');
$mother          = trim($_POST['mother'] ?? '');
$dob             = trim($_POST['dob'] ?? '');
$nationality     = trim($_POST['nationality'] ?? '');
$address         = trim($_POST['address'] ?? '');
$state           = trim($_POST['state'] ?? '');
$district        = trim($_POST['district'] ?? '');
$mobile          = trim($_POST['mobile'] ?? '');
$bloodgroup      = trim($_POST['bloodgroup'] ?? '');
$gender          = trim($_POST['gender'] ?? 'Male');
$police          = trim($_POST['police'] ?? '');
$qualification   = trim($_POST['qualification'] ?? '');
$school          = trim($_POST['school'] ?? '');
$idmark          = trim($_POST['idmark'] ?? '');
$aadhaar         = trim($_POST['aadhaar'] ?? '');

// ------------------------
// ID Generation
// ------------------------
function generateID($conn,$gender,$table,$id_column){
    $year = date('Y');
    $gender_code = $gender==='Male'?'SD':'SW';
    $prefix="WB{$year}{$gender_code}MCS777";

    $sql="SELECT $id_column FROM $table WHERE gender=? AND $id_column LIKE ? ORDER BY $id_column DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $likePattern=$prefix."%";
    $stmt->bind_param("ss",$gender,$likePattern);
    $stmt->execute();
    $stmt->bind_result($lastID);
    $stmt->fetch();
    $stmt->close();

    $number = $lastID ? (int)substr($lastID,-3)+1 : 1;
    return $prefix.str_pad($number,3,'0',STR_PAD_LEFT);
}

$cadet_id = generateID($conn,$gender,'cadet_enrollment','cadet_id');

// ------------------------
// File Uploads
// ------------------------
$upload_dir="uploads/";
if(!is_dir($upload_dir)) mkdir($upload_dir,0777,true);

function uploadFile($fileInput,$upload_dir){
    if(!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['error']!=0) return '';
    $filename = time().'_'.preg_replace('/[^A-Za-z0-9\.\-_]/','',basename($_FILES[$fileInput]['name']));
    $target = $upload_dir.$filename;
    return move_uploaded_file($_FILES[$fileInput]['tmp_name'],$target)?$target:'';
}

$aadhaarCard   = uploadFile("aadhaarCard",$upload_dir);
$bankPassbook  = uploadFile("bankPassbook",$upload_dir);
$birthCert     = uploadFile("birthCert",$upload_dir);
$marksheet     = uploadFile("marksheet",$upload_dir);
$bondPaper     = uploadFile("bondPaper",$upload_dir);
$declaration   = uploadFile("declaration",$upload_dir);
$medicalCert   = uploadFile("medicalCert",$upload_dir);
$photo         = uploadFile("photo",$upload_dir);
$signature     = uploadFile("signature",$upload_dir);

// ------------------------
// Insert into Database
// ------------------------
$insert_sql = "INSERT INTO cadet_enrollment
(cadet_id,name,father,mother,dob,nationality,address,state,district,mobile,bloodgroup,gender,police,qualification,school,idmark,aadhaar,aadhaarCard,bankPassbook,birthCert,bondPaper,declaration,medicalCert,photo,signature)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($insert_sql);
if(!$stmt){
    die("DB Prepare failed: " . $conn->error);
}

$bindResult = $stmt->bind_param("sssssssssssssssssssssssss",
    $cadet_id,$cadet_name,$father,$mother,$dob,$nationality,$address,$state,$district,$mobile,$bloodgroup,$gender,$police,$qualification,$school,$idmark,$aadhaar,$aadhaarCard,$bankPassbook,$birthCert,$bondPaper,$declaration,$medicalCert,$photo,$signature
);
if(!$bindResult){
    die("DB Bind failed: " . $stmt->error);
}

$execResult = $stmt->execute();
if(!$execResult){
    die("DB Execute failed: " . $stmt->error);
}

$stmt->close();

// ------------------------
// Generate and Download PDF
// ------------------------
require('fpdf/fpdf.php');

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
$pdf->Cell(0,10,'CADET ENROLLMENT FORM',0,1,'C');
$pdf->Ln(5);

// Cadet identity block
$pdf->SetFont('Arial','B',12);
$pdf->Cell(35,8,'Registration:',0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,$cadet_id,0,1);
$pdf->Ln(3);

// Portrait area
if (file_exists($photo) && !empty($photo)) {
    $pdf->Image($photo, 145, 50, 45, 55);
} else {
    $pdf->Rect(145, 50, 45, 55);
    $pdf->SetXY(145, 106);
    $pdf->SetFont('Arial','I',8);
    $pdf->Cell(45,4,'Photo',0,0,'C');
}

// For consistent alignment
$pdf->SetXY(10, 55);

$fields = [
    'Reg No.' => $cadet_id,
    'Name' => $cadet_name,
    'Address' => $address,
    'Blood Group' => $bloodgroup,
    'Contact No.' => $mobile,
    'Father' => $father,
    'Mother' => $mother,
    'DOB' => $dob,
    'Nationality' => $nationality,
    'State' => $state,
    'District' => $district,
    'Gender' => $gender,
    'Police Station' => $police,
    'Qualification' => $qualification,
    'School/College' => $school,
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

echo "<h2>Enrollment Successful!</h2>";
echo "<p><strong>Registration No:</strong> $cadet_id</p>";
echo "<p><strong>Name:</strong> $cadet_name</p>";
echo "<p><strong>Mobile:</strong> $mobile</p>";
echo "<p><strong>Blood Group:</strong> $bloodgroup</p>";
echo "<p><a href='cadet_enrollment.php'>Submit Another Enrollment</a></p>";

mysqli_close($conn);
exit();