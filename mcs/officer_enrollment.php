<?php
session_start();

if(!isset($_SESSION['officer_id'])){
header("Location: officer_login.html");
exit();
}

$officer_name = $_SESSION['officer_name'];
$officer_id = $_SESSION['officer_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Officer Enrollment Form - Marine Command Squad</title>

<link rel="stylesheet" href="officer_enrollment.css">

</head>

<body>

<nav class="navbar">

<div class="logo">
<img src="logo.jpeg" class="logo-img">
<span>Marine Command Squad</span>
</div>

</nav>

<h2>Officer Enrollment Form</h2>

<p>Logged in as: <b><?php echo $officer_name; ?> (Officer)</b></p>

<form id="officerEnrollmentForm"
action="officer_enrollment_process.php"
method="POST"
enctype="multipart/form-data">

<!-- hidden officer id -->
<input type="hidden" name="officer_id" value="<?php echo $officer_id; ?>">

<label for="fullName">Full Name</label>
<input type="text" id="fullName" name="name" required>

<label for="rank">Rank</label>
<input type="text" id="rank" name="rank" required>

<label for="registrationNumber">Registration Number</label>
<input type="text" id="registrationNumber" name="registration_number" required>

<label for="dob">Date of Birth</label>
<input type="date" id="dob" name="dob" required>

<label for="nationality">Nationality</label>
<input type="text" id="nationality" name="nationality" required>

<label for="address">Address</label>
<textarea id="address" name="address" required></textarea>

<label for="state">State</label>
<input type="text" id="state" name="state" required>

<label for="district">District</label>
<input type="text" id="district" name="district" required>

<label for="mobile">Mobile Number</label>
<input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" required>

<label for="bloodGroup">Blood Group</label>
<input type="text" id="bloodGroup" name="bloodgroup" required>

<label for="gender">Gender</label>
<select id="gender" name="gender" required>
<option value="">Select</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>

<label for="policeStation">Police Station</label>
<input type="text" id="policeStation" name="police" required>

<label for="qualification">Educational Qualification</label>
<input type="text" id="qualification" name="qualification" required>

<label for="institution">School/College Name</label>
<input type="text" id="institution" name="institution" required>

<label for="idMark">Identification Mark</label>
<input type="text" id="idMark" name="idmark" required>

<label for="aadhaar">Aadhaar Number</label>
<input type="text" id="aadhaar" name="aadhaar" pattern="[0-9]{12}" required>

<!-- File Uploads -->

<label for="aadhaarCard">Aadhaar Card</label>
<input type="file" id="aadhaarCard" name="aadhaarCard" required>

<label for="bankPassbook">Bank Passbook</label>
<input type="file" id="bankPassbook" name="bankPassbook" required>

<label for="birthCert">Birth Certificate</label>
<input type="file" id="birthCert" name="birthCert" required>

<label for="institutionCert">School/College Certificate</label>
<input type="file" id="institutionCert" name="institutionCert" required>

<label for="declaration">Declaration</label>
<input type="file" id="declaration" name="declaration" required>

<label for="medicalCert">Medical Certificate</label>
<input type="file" id="medicalCert" name="medicalCert" required>

<label for="photo">Photo</label>
<input type="file" id="photo" name="photo" required>

<label for="signature">Signature</label>
<input type="file" id="signature" name="signature" required>

<button type="submit">Submit Enrollment</button>

</form>

</body>
</html>