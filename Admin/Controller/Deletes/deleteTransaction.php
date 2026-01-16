<?php
session_start();
include "../../Model/DatabaseConnection.php";

if(!isset($_GET['id'])) {
    header("Location: ../../View/AdminDash/transactions.php");
    exit;
}

$transactionId = intval($_GET['id']);

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "DELETE FROM transactions WHERE transaction_id = $transactionId";

if($conn->query($sql)){
    header("Location: ../../View/AdminDash/transactions.php?msg=deleted");
}else{
    echo "Delete failed!";
}
