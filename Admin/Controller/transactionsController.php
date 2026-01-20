<?php
session_start();
include_once "../../Controller/authCheck.php";
include_once "../../Model/DatabaseConnection.php";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if (!$isLoggedIn) {
    Header("Location: ../Auth/login.php");
}
$email = $_SESSION["email"] ?? "";
$username = $_SESSION["username"] ?? "";

$db = new DatabaseConnection();
$connection = $db->openConnection();

$transactionsResult = $db->getAllTransactions($connection);

?>