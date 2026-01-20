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
$connection = $db->openConnection();

$buyersResult = $db->getAllBuyers($connection);
