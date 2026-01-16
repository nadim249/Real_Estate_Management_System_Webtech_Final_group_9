<?php
session_start();
require_once "../../Model/DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location:../../View/AdminDash/Dashboard.php");
    exit;
}

$adminId  = intval($_POST['admin_id']);
$username = $_POST['username'];
$email    = $_POST['email'];
$password = $_POST['password'];

$db = new DatabaseConnection();
$conn = $db->openConnection();

if (!empty($password)) {
    $sql = "UPDATE admins SET username=?, email=?, password=? WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $password, $adminId);
} else {
    $sql = "UPDATE admins SET username=?, email=? WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $email, $adminId);
}

if ($stmt->execute()) {
    // Update session info
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    header("Location: ../../View/AdminDash/dashboard.php?msg=updated");
} else {
    echo "Update failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
