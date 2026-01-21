<?php
session_start();
require_once "../Model/DatabaseConnection.php";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
$userId = $_SESSION["user_id"] ?? null;

if(!$isLoggedIn || !$userId){
  header("Location: ../View/login.php");
  exit;
}

if(!isset($_POST['property_id'], $_POST['booking_amount'])){
  header("Location: ../View/properties.php");
  exit;
}

$propertyId = (int)$_POST['property_id'];
$bookingAmount = (float)$_POST['booking_amount'];

if($bookingAmount <= 0){
  header("Location: ../View/viewdetails.php?id=".$propertyId."&msg=amount");
  exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmtP = $conn->prepare("SELECT price, agent_id FROM properties WHERE property_id=?");
$stmtP->bind_param("i", $propertyId);
$stmtP->execute();
$resP = $stmtP->get_result();

if(!$resP || $resP->num_rows !== 1){
  header("Location: ../View/properties.php");
  exit;
}

$p = $resP->fetch_assoc();
$fullPrice = (float)$p['price'];
$agentId = (int)$p['agent_id'];

$stmt = $conn->prepare("INSERT INTO transactions (property_id, user_id, agent_id, booking_amount, full_price)
                        VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iiidd", $propertyId, $userId, $agentId, $bookingAmount, $fullPrice);

if($stmt->execute()){
  header("Location: ../View/viewdetails.php?id=".$propertyId."&msg=booked");
  exit;
}

header("Location: ../View/viewdetails.php?id=".$propertyId."&msg=error");
exit;
