<?php
session_start();
require_once "../../Model/DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../View/AdminDash/Dashboard.php");
    exit;
}

$adminId  = intval($_POST['admin_id']);
$username = trim($_POST['username']);
$email    = trim($_POST['email']);
$password = trim($_POST['password']);

$db = new DatabaseConnection();
$conn = $db->openConnection();

$checkSql = "SELECT admin_id FROM admins 
             WHERE (username = ? OR email = ?) AND admin_id != ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("ssi", $username, $email, $adminId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    header("Location: ../../View/AdminDash/Edit/editProfile.php?msg=already_exists");
    exit;
}
$checkStmt->close();

if ($password !== "") {
    $sql = "UPDATE admins SET username=?, email=?, password=? WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $password, $adminId);
} else {
    $sql = "UPDATE admins SET username=?, email=? WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $email, $adminId);
}

if ($stmt->execute()) {
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    header("Location: ../../View/AdminDash/dashboard.php?msg=updated");
    exit;
} else {
    header("Location: ../../View/AdminDash/Edit/editProfile.php?msg=failed");
    exit;
}

$stmt->close();
$conn->close();
