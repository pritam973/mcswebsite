<?php

require_once 'config.php';

// Validate input
$required_fields = ['aadhaar', 'cadetName', 'middleName', 'surname', 'fatherName', 'motherName', 'gender', 'dob', 'mobile', 'password'];
foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
        die("Missing required field: $field");
    }
}

// Sanitize input
$aadhaar = trim($_POST['aadhaar']);
$name = trim($_POST['cadetName']);
$middle = trim($_POST['middleName']);
$surname = trim($_POST['surname']);
$father = trim($_POST['fatherName']);
$mother = trim($_POST['motherName']);
$gender = trim($_POST['gender']);
$dob = trim($_POST['dob']);
$mobile = trim($_POST['mobile']);
$password = trim($_POST['password']);

// Validate Aadhaar (12 digits)
if (!preg_match('/^[0-9]{12}$/', $aadhaar)) {
    die("Invalid Aadhaar number");
}

// Validate mobile (10 digits)
if (!preg_match('/^[0-9]{10}$/', $mobile)) {
    die("Invalid mobile number");
}

// Validate password strength
if (strlen($password) < 6) {
    die("Password must be at least 6 characters");
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Use prepared statement
$stmt = $conn->prepare("INSERT INTO student_register 
(aadhaar, cadetName, middleName, surname, fatherName, motherName, gender, dob, mobile, password)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("ssssssssss", $aadhaar, $name, $middle, $surname, $father, $mother, $gender, $dob, $mobile, $hashed_password);

if ($stmt->execute()) {
    echo "Registration Successful";
    $stmt->close();
} else {
    echo "Error: " . $stmt->error;
    $stmt->close();
}

mysqli_close($conn);
?>