<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: cadet_enrollment.php");
    exit();
}

if(!isset($_SESSION['cadet_id'])){
    header("Location: cadet_login.html");
    exit();
}

$conn = mysqli_connect("localhost","root","", "mcs1");
if(!$conn){
    die("DB Connection failed: ".mysqli_connect_error());
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
// Show Details
// ------------------------
echo "<h2>Enrollment Successful!</h2>";
echo "<p><b>Registration No:</b> $cadet_id</p>";
echo "<p><b>Name:</b> $cadet_name</p>";
echo "<p><b>Gender:</b> $gender</p>";
echo "<p><b>DOB:</b> $dob</p>";
echo "<p><b>Mobile:</b> $mobile</p>";
echo "<img src='$photo' width='150' alt='Cadet Photo'><hr>";

// ------------------------
// PDF Generation
// ------------------------
require('fpdf/fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Cadet Enrollment Form',0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,8,'Registration No:',0,0);
$pdf->Cell(0,8,$cadet_id,0,1);

$fields=[
'Full Name'=>$cadet_name,'Father'=>$father,'Mother'=>$mother,'DOB'=>$dob,
'Nationality'=>$nationality,'Address'=>$address,'State'=>$state,'District'=>$district,
'Mobile'=>$mobile,'Blood Group'=>$bloodgroup,'Gender'=>$gender,'Police'=>$police,
'Qualification'=>$qualification,'School'=>$school,'Identification Mark'=>$idmark,'Aadhaar No'=>$aadhaar
];

foreach($fields as $label=>$value){
    $pdf->Cell(50,8,$label.':',0,0);
    $pdf->MultiCell(0,8,$value);
}

if(file_exists($photo)){
    $pdf->Ln(5);
    $pdf->Cell(0,8,'Photo:',0,1);
    $pdf->Image($photo,10,$pdf->GetY(),40,50);
}

// Save PDF to uploads and give download link (prevents headers-already-sent issues)
$pdfFile = $upload_dir . "Cadet_Enrollment_{$cadet_id}.pdf";
$pdfSave = $pdf->Output('F', $pdfFile);

if($pdfSave){
    echo "<p><a href='$pdfFile' target='_blank'>Download your enrollment PDF</a></p>";
} else {
    echo "<p><strong>Warning:</strong> PDF could not be created. Please contact admin.</p>";
}
?>