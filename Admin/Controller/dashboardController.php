<?php
session_start();
include_once "../../Controller/authCheck.php";
include_once "../../Model/DatabaseConnection.php";

if (!($_SESSION["isLoggedIn"] ?? false)) {
    header("Location: ../Auth/login.php");
    exit;
}

$username = $_SESSION['username'] ?? '';
$email    = $_SESSION['email'] ?? '';

$db = new DatabaseConnection();
$conn = $db->openConnection();

$totalUsers = $db->fetchCount($conn, "buyers");
$totalProperties = $db->fetchCount($conn, "properties");
$pendingApprovals = $db->fetchCount($conn, "properties", "*", "status='Pending'");
$totalSold = $db->fetchCount($conn, "properties", "*", "is_sold=1");
$totalSoldThisMonth = $db->fetchCount(
    $conn,
    "properties",
    "*",
    "is_sold = 1 AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())"
);

$recentProperties = $db->getRecentProperties($conn);
