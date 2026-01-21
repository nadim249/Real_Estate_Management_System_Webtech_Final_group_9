<?php
session_start();
require_once "../Model/DatabaseConnection.php";

if (!isset($_POST['email'], $_POST['password'])) {
    header("Location: ../View/forget.php");
    exit;
}

$email = trim($_POST['email']);
$newPassword = trim($_POST['password']);

if (empty($email) || empty($newPassword)) {
    $_SESSION["emailErr"] = "Please enter both email and new password.";
    header("Location: ../View/forget.php");
    exit;
}



$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare("SELECT user_id FROM buyers WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows !== 1) {
    $_SESSION["emailErr"] = "No account found with that email.";
    header("Location: ../View/forget.php");
    exit;
}

$stmtUpdate = $conn->prepare("UPDATE buyers SET password=? WHERE email=?");
$stmtUpdate->bind_param("ss", $newPassword, $email);

if ($stmtUpdate->execute()) {
    $_SESSION["resetSuccess"] = "Your password has been reset successfully.";
    header("Location: ../View/forget.php");
    exit;
} else {
    $_SESSION["passwordErr"] = "Failed to reset the password. Please try again.";
    header("Location: ../View/forget.php");
    exit;
}
