<?php
session_start();
include "../Model/DatabaseConnection.php";

if (!isset($_GET['id'])) {
    header("Location: ../View/transactions.php");
    exit;
}

$transactionId = intval($_GET['id']);

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "UPDATE transactions SET status='Completed' WHERE transaction_id = $transactionId";

if ($conn->query($sql)) {
    header("Location: ../View/AdminDash/transactions.php?msg=approved");
} else {
    echo "Approve failed!";
}
