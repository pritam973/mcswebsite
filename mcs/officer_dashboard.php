<?php
session_start();

if(!isset($_SESSION['officer_id'])){
header("Location: officer_login.html");
exit();
}

$officer_name = $_SESSION['officer_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Officer Dashboard - Marine Command Squad</title>

<link rel="stylesheet" href="officer_dashboard.css">

<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto&display=swap" rel="stylesheet">

</head>

<body>

<nav class="navbar">

<div class="logo">
<img src="logo.jpeg" class="logo-img">
<span>Marine Command Squad</span>
</div>

<ul class="nav-links">
<li><a href="#">Dashboard</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>

</nav>

<div class="dashboard-header">

<h1>Marine Command Squad</h1>

<h2>Officer Dashboard</h2>

<p>Welcome Officer: <strong><?php echo $officer_name; ?></strong></p>

</div>

<div class="form-container">

<h2>Officer Enrollment Form</h2>

<form action="officer_enrollment_process.php" method="POST" enctype="multipart/form-data">

<label>Full Name
<input type="text" name="name" required>
</label>

<label>Rank
<input type="text" name="rank" required>
</label>

<label>Registration Number
<input type="text" name="officer_id" required>
</label>

<label>Date of Birth
<input type="date" name="dob" required>
</label>

<label>Nationality
<input type="text" name="nationality" required>
</label>

<label>Address
<textarea name="address" required></textarea>
</label>

<label>State
<input type="text" name="state" required>
</label>

<label>District
<input type="text" name="district" required>
</label>

<label>Mobile Number
<input type="tel" name="mobile" pattern="[0-9]{10}" required>
</label>

<label>Blood Group
<input type="text" name="bloodgroup" required>
</label>

<label>Gender
<select name="gender" required>
<option value="">Select</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>
</label>

<label>Police Station
<input type="text" name="police" required>
</label>

<label>Educational Qualification
<input type="text" name="qualification" required>
</label>

<label>School/College Name
<input type="text" name="institution" required>
</label>

<label>Identification Mark
<input type="text" name="idmark" required>
</label>

<label>Aadhaar Number
<input type="text" name="aadhaar" pattern="[0-9]{12}" required>
</label>

<label>Aadhaar Card
<input type="file" name="aadhaarCard" required>
</label>

<label>Bank Passbook
<input type="file" name="bankPassbook" required>
</label>

<label>Birth Certificate
<input type="file" name="birthCert" required>
</label>

<label>School/College Certificate
<input type="file" name="institutionCert" required>
</label>

<label>Declaration
<input type="file" name="declaration" required>
</label>

<label>Medical Certificate
<input type="file" name="medicalCert" required>
</label>

<label>Photo
<input type="file" name="photo" required>
</label>

<label>Signature
<input type="file" name="signature" required>
</label>

<button type="submit">Submit Enrollment</button>

</form>

</div>

</body>
</html>