<?php
session_start();
include "../../Model/DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../View/AdminDash/transactions.php");
    exit;
}

$transactionId = intval($_POST['transaction_id']);
$bookingAmount = floatval($_POST['booking_amount']);
$fullPrice     = floatval($_POST['full_price']);
$paymentMethod = $_POST['payment_method'];
$status        = $_POST['status'];

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "UPDATE transactions
        SET booking_amount = ?, full_price = ?, payment_method = ?, status = ?
        WHERE transaction_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ddssi", $bookingAmount, $fullPrice, $paymentMethod, $status, $transactionId);

if ($stmt->execute()) {
    header("Location: ../../View/AdminDash/transactions.php?msg=updated");
} else {
    echo "Update failed!";
}
