<?php
session_start();
require_once "../../Model/DatabaseConnection.php";

if(!isset($_GET['id'])){
    header("Location: ../../View/AdminDash/agents.php");
    exit;
}

$agentId = intval($_GET['id']);
$db = new DatabaseConnection();
$conn = $db->openConnection();

// Check if agent has properties
$sqlCheck = "SELECT * FROM properties WHERE agent_id = $agentId";
$resultCheck = $conn->query($sqlCheck);

if($resultCheck->num_rows > 0){
    $_SESSION['agentDeleteErr'] = "Cannot delete agent with assigned properties!";
    header("Location: ../View/AdminDash/agents.php");
    exit;
}

$sql = "DELETE FROM agents WHERE agent_id = $agentId";
if($conn->query($sql)){
    header("Location: ../View/AdminDash/agents.php?msg=deleted");
} else {
    echo "Delete failed!";
}
