<?php
session_start();
require_once "../../Model/DatabaseConnection.php";
require_once "../../Model/tansactionsmodel.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../../View/AdminDash/transactions.php");
    exit;
}

$transactionId = intval($_GET['id']);
$db = new DatabaseConnection();
$conn = $db->openConnection();

$transactionModel = new TransactoionModel($conn);

if (!$transactionModel->exists($transactionId)) {
    $_SESSION['transactionDeleteErr'] = "Transaction not found!";
    header("Location: ../../View/AdminDash/transactions.php");
    exit;
}

if ($transactionModel->deleteTransaction($transactionId)) {
    header("Location: ../../View/AdminDash/transactions.php?msg=deleted");
} else {
    $_SESSION['transactionDeleteErr'] = "Delete failed!";
    header("Location: ../../View/AdminDash/transactions.php");
}

$conn->close();
exit;
