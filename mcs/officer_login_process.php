<?php

require_once 'config.php';
session_start();

// Validate input
if (!isset($_POST['mobileNumber']) || !isset($_POST['password'])) {
    die("Missing login credentials");
}

$mobile = trim($_POST['mobileNumber']);
$password = trim($_POST['password']);

if (empty($mobile) || empty($password)) {
    die("Mobile number and password are required");
}

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT id, officerName, password FROM officer_register WHERE mobileNumber = ?");
if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("s", $mobile);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        $_SESSION['officer_id'] = $row['id'];
        $_SESSION['officer_name'] = htmlspecialchars($row['officerName']);
        $stmt->close();
        header("Location: officer_dashboard.php");
        exit();
    } else {
        $stmt->close();
        die("Incorrect Password");
    }
} else {
    $stmt->close();
    die("Officer not registered");
}

mysqli_close($conn);
?>