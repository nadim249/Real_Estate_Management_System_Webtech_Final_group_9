<?php
session_start();
include_once "../../Controller/authCheck.php";
include_once "../../Model/DatabaseConnection.php";
require_once "../../Model/UserModel.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();

$user = new UserModel($conn);


if (!($_SESSION["isLoggedIn"] ?? false)) {
    header("Location: ../Auth/login.php");
    exit;
}

$username = $_SESSION['username'] ?? '';
$email    = $_SESSION['email'] ?? '';



$buyersResult = $user->getAllBuyers();
