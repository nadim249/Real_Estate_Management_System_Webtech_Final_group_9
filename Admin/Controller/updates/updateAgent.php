<?php
session_start();
require_once "../Model/DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../View/AdminDash/agents.php");
    exit;
}

$agentId = intval($_POST['agent_id']);
$fullName = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$commission = floatval($_POST['commission']);

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "UPDATE agents 
        SET full_name = ?, email = ?, phone = ?, commission = ? 
        WHERE agent_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdi", $fullName, $email, $phone, $commission, $agentId);

if($stmt->execute()){
    header("Location: ../View/AdminDash/agents.php?msg=updated");
} else {
    echo "Update failed!";

}
$stmt->close();
$conn->close();