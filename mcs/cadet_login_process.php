<?php

require_once 'config.php';
session_start();

// Validate input
if (!isset($_POST['mobnumber']) || !isset($_POST['password'])) {
    die("Missing login credentials");
}

$mobile = trim($_POST['mobnumber']);
$password = trim($_POST['password']);

if (empty($mobile) || empty($password)) {
    die("Mobile number and password are required");
}

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT id, cadetName, password FROM student_register WHERE mobile = ?");
if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("s", $mobile);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        $_SESSION['cadet_name'] = htmlspecialchars($row['cadetName']);
        $_SESSION['cadet_id'] = $row['id'];
        $stmt->close();
        header("Location: cadet_dashboard.php");
        exit();
    } else {
        $stmt->close();
        die("Incorrect Password");
    }
} else {
    $stmt->close();
    die("Cadet Not Registered");
}

mysqli_close($conn);
?>