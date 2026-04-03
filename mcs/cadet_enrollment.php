<?php
session_start();

if(!isset($_SESSION['cadet_id'])){
header("Location: cadet_login.html");
exit();
}

$cadet_name = $_SESSION['cadet_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Cadet Enrollment</title>

<link rel="stylesheet" href="cadet_enrollment.css">

<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
<div class="logo">
<img src="logo.jpeg" class="logo-img">
<span>Marine Command Squad</span>
</div>
</nav>

<!-- HEADER -->
<div class="header-center">
<h1 class="main-title">Marine Command Squad</h1>
<h2 class="subtitle">Cadet Enrollment Form</h2>
<p class="welcome">Welcome Cadet: <b><?php echo $cadet_name; ?></b></p>
</div>

<!-- FORM -->
<form action="cadet_enrollment_process.php" method="POST" enctype="multipart/form-data">

<label>Name<input type="text" name="name" required></label>
<label>Father<input type="text" name="father" required></label>
<label>Mother<input type="text" name="mother" required></label>
<label>DOB<input type="date" name="dob" required></label>
<label>Nationality<input type="text" name="nationality" required></label>
<label>Address<textarea name="address" required></textarea></label>
<label>State<input type="text" name="state" required></label>
<label>District<input type="text" name="district" required></label>
<label>Mobile<input type="text" name="mobile" required></label>
<label>Blood Group<input type="text" name="bloodgroup" required></label>

<label>Gender
<select name="gender" required>
<option value="">Select</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</label>

<label>Police<input type="text" name="police" required></label>
<label>Qualification<input type="text" name="qualification" required></label>
<label>School<input type="text" name="school" required></label>
<label>ID Mark<input type="text" name="idmark" required></label>
<label>Aadhaar<input type="text" name="aadhaar" required></label>

<!-- FILES -->
<label>Aadhaar Card<input type="file" name="aadhaarCard" required></label>
<label>Bank Passbook<input type="file" name="bankPassbook" required></label>
<label>Birth Certificate<input type="file" name="birthCert" required></label>
<label>Marksheet<input type="file" name="marksheet" required></label>
<label>Bond Paper<input type="file" name="bondPaper" required></label>
<label>Declaration<input type="file" name="declaration" required></label>
<label>Medical Certificate<input type="file" name="medicalCert" required></label>
<label>Photo<input type="file" name="photo" required></label>
<label>Signature<input type="file" name="signature" required></label>

<!-- BUTTON -->
<button type="button" onclick="generateIDCard()">Download ID Card</button>

</form>

</body>
</html>

<script>

async function generateIDCard(){

const { jsPDF } = window.jspdf;
const pdf = new jsPDF();

// GET VALUES
let name = document.querySelector('[name="name"]').value;
let address = document.querySelector('[name="address"]').value;
let blood = document.querySelector('[name="bloodgroup"]').value;
let mobile = document.querySelector('[name="mobile"]').value;

// YEAR + GENDER
let year = new Date().getFullYear();
let gender = document.querySelector('[name="gender"]').value;
let genderCode = (gender === "Male") ? "SD" : "SW";

// ID
let regNo = "WB" + year + genderCode + "MCS777001";

// BORDER
pdf.rect(10, 10, 190, 120);

// LOAD LOGO
let logo = new Image();
logo.src = "logo.jpeg"; // make sure this file exists

logo.onload = function(){

// LOGO
pdf.addImage(logo, 'PNG', 85, 12, 40, 25);

// HEADER
pdf.setFont("helvetica","bold");
pdf.setFontSize(16);
pdf.text("MARINE COMMAND SQUAD", 105, 45, null, null, "center");

pdf.setFontSize(12);
pdf.text("CADET ENROLLMENT", 105, 53, null, null, "center");

// DETAILS
pdf.setFont("helvetica","normal");
pdf.setFontSize(11);

pdf.text("Reg No: " + regNo, 20, 70);
pdf.text("Name: " + name, 20, 80);

// MULTILINE ADDRESS
let splitAddress = pdf.splitTextToSize("Address: " + address, 90);
pdf.text(splitAddress, 20, 90);

pdf.text("Blood Group: " + blood, 20, 110);
pdf.text("Contact No: " + mobile, 20, 120);

// PHOTO BOX
pdf.rect(140, 70, 40, 40);

// PHOTO
let fileInput = document.querySelector('[name="photo"]');
let file = fileInput.files[0];

if(file){
let reader = new FileReader();

reader.onload = function(e){
pdf.addImage(e.target.result, 'JPEG', 140, 70, 40, 40);
pdf.save("Cadet_ID_Card.pdf");
}

reader.readAsDataURL(file);

}else{
pdf.save("Cadet_ID_Card.pdf");
}

};

}
</script>