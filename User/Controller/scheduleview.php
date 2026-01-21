<?php
session_start();
require_once "../Model/DatabaseConnection.php";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
$userId = $_SESSION["user_id"] ?? null;  

if (!$isLoggedIn || !$userId) {
    header("Location: ../View/login.php");
    exit;
}

if (!isset($_GET['property_id'], $_GET['schedule_date'], $_GET['schedule_time'])) {
    header("Location: ../View/properties.php");
    exit;
}

$propertyId = (int)$_GET['property_id'];
$scheduleDate = $_GET['schedule_date'];
$scheduleTime = $_GET['schedule_time'];
$buyerNote = trim($_GET['buyer_note'] ?? "");


$scheduleDateTime = $scheduleDate . " " . $scheduleTime . ":00";

$db = new DatabaseConnection();
$conn = $db->openConnection();

$agentId = 0;
$stmtAgent = $conn->prepare("SELECT agent_id FROM properties WHERE property_id = ?");
$stmtAgent->bind_param("i", $propertyId);
$stmtAgent->execute();
$resAgent = $stmtAgent->get_result();
if ($resAgent && $resAgent->num_rows === 1) {
    $agentId = (int)$resAgent->fetch_assoc()['agent_id'];
}

$status = "Requested";

$stmt = $conn->prepare("
    INSERT INTO viewings (user_id, property_id, agent_id, schedule_date, status, buyer_note)
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("iiisss", $userId, $propertyId, $agentId, $scheduleDateTime, $status, $buyerNote);

if ($stmt->execute()) {
    header("Location: ../View/viewdetails.php?id=" . $propertyId . "&msg=requested");
    exit;
} else {
    header("Location: ../View/viewdetails.php?id=" . $propertyId . "&msg=error");
    exit;
}
