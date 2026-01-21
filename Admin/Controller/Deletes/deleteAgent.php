<?php
session_start();
require_once "../../Model/DatabaseConnection.php";
require_once "../../Model/agentsmodel.php";

if(!isset($_GET['id'])){
    header("Location: ../../View/AdminDash/agents.php");
    exit;
}

$agentId = intval($_GET['id']);
$db = new DatabaseConnection();
$conn = $db->openConnection();

$agentModel = new AgentModel($conn);

if ($agentModel->hasProperties($agentId)) {
    $_SESSION['agentDeleteErr'] = "Cannot delete agent with assigned properties!";
    header("Location: ../../View/AdminDash/agents.php");
    exit;
}

if ($agentModel->deleteAgent($agentId)) {
    header("Location: ../../View/AdminDash/agents.php?msg=deleted");
} else {
    $_SESSION['agentDeleteErr'] = "Delete failed!";
    header("Location: ../../View/AdminDash/agents.php");
}
