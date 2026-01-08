<?php
include "../Model/DatabaseConnection.php";
session_start();

if(!($_SESSION["isLoggedIn"] ?? false)){
    header("Location: ../View/Auth/login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if(!$id) exit;

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare("UPDATE properties SET status='Active' WHERE property_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../View/AdminDash/approvals.php");
