<?php
session_start();
require_once "../Model/DatabaseConnection.php";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
$userId = $_SESSION["user_id"] ?? null;

if(!$isLoggedIn || !$userId){
    header("Location: ../View/login.php");
    exit;
}

if(!isset($_POST['property_id'], $_POST['message'])){
    header("Location: ../View/properties.php");
    exit;
}

$propertyId = (int)$_POST['property_id'];
$message = trim($_POST['message']);

if($message === ""){
    header("Location: ../View/viewdetails.php?id=".$propertyId."&msg=empty");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$agentId = 0;
$stmtAgent = $conn->prepare("SELECT agent_id FROM properties WHERE property_id=?");
$stmtAgent->bind_param("i", $propertyId);
$stmtAgent->execute();
$res = $stmtAgent->get_result();

if($res && $res->num_rows === 1){
    $agentId = (int)$res->fetch_assoc()['agent_id'];
}

$status = "Unread";

$stmt = $conn->prepare("
  INSERT INTO inquiries (user_id, agent_id, property_id, message, created_at, status)
  VALUES (?, ?, ?, ?, NOW(), ?)
");
$stmt->bind_param("iiiss", $userId, $agentId, $propertyId, $message, $status);

if($stmt->execute()){
    header("Location: ../View/viewdetails.php?id=".$propertyId."&msg=sent");
    exit;
}else{
    header("Location: ../View/viewdetails.php?id=".$propertyId."&msg=error");
    exit;
}
