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

<title>Cadet Dashboard - Marine Command Squad</title>

<link rel="stylesheet" href="cadet_dashboard.css">

</head>

<body>

<nav class="navbar">

<div class="logo">
<img src="logo.jpeg" class="logo-img">
<span>Marine Command Squad</span>
</div>

<ul class="nav-links">
<li><a href="#">Dashboard</a></li>
<li><a href="cadet_enrollment.php">Enrollment</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>

</nav>

<div class="dashboard-header">

<h1>Marine Command Squad</h1>

<h2>Cadet Dashboard</h2>

<p>Welcome Cadet: <strong><?php echo $cadet_name; ?></strong></p>

</div>

<div class="dashboard-card">

<h3>Cadet Enrollment</h3>

<p>Complete your enrollment form to receive your official Cadet ID.</p>

<a href="cadet_enrollment.php" class="dashboard-btn">Open Enrollment Form</a>

</div>

</body>
</html>