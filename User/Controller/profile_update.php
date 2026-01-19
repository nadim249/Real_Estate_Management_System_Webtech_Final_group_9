<?php
session_start();
require_once "../Model/DatabaseConnection.php";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
$userId = $_SESSION["user_id"] ?? null;

if(!$isLoggedIn || !$userId){
  header("Location: ../View/login.php");
  exit;
}

if(!isset($_POST['name'])){
  header("Location: ../View/profile.php");
  exit;
}

$name = trim($_POST['name']);
$phone = trim($_POST['phone'] ?? "");
$email = trim($_POST['email'] ?? "");

if($name === ""){
  header("Location: ../View/profile.php");
  exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare("UPDATE buyers SET full_name=?,email=?, phone=? WHERE user_id=?");
$stmt->bind_param("sssi", $name,$email, $phone, $userId);

if($stmt->execute()){
  header("Location: ../View/profile.php?msg=updated");
  exit;
}
header("Location: ../View/profile.php?msg=error");
exit;
