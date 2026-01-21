<?php
session_start();
include_once "../../Controller/authCheck.php";
include_once "../../Model/DatabaseConnection.php";
require_once "../../Model/agentsmodel.php";

if (!($_SESSION["isLoggedIn"] ?? false)) {
    header("Location: ../Auth/login.php");
    exit;
}

$username = $_SESSION['username'] ?? '';
$email    = $_SESSION['email'] ?? '';

$db = new DatabaseConnection();
$conn = $db->openConnection();

$agent = new AgentModel($conn);

$agentsResult = $agent->getAllAgents();
