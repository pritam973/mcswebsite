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

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
<div class="logo">
<img src="logo.jpeg" class="logo-img">
<span>Marine Command Squad</span>
</div>
</nav>

<!-- CENTER HEADER -->
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

<button type="submit">Submit</button>

</form>

</body>
</html>