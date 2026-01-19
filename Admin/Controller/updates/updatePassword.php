<?php
session_start();
include "../../Model/DatabaseConnection.php";

if ($_POST['password'] !== $_POST['confirm']) {
  header("Location: ../../View/Auth/resetPassword.php?error=nomatch");
  exit;
}

$password = $_POST['password'];
$db = new DatabaseConnection();
$conn = $db->openConnection();
$stmt = $conn->prepare(
  "UPDATE admins SET password=? WHERE admin_id=?"
);
$stmt->bind_param("si", $password, $_SESSION['reset_id']);
$stmt->execute();

session_destroy();

header("Location: ../../View/Auth/resetPassword.php?success=1");
exit;
