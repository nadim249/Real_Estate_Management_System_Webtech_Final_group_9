<?php
session_start();
require_once "../Model/DatabaseConnection.php";

if (!isset($_GET['id'])) {
    header("Location: ../View/AdminDash/users.php");
    exit;
}

$userId = intval($_GET['id']);

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "DELETE FROM buyers WHERE user_id = $userId";

if ($conn->query($sql)) {
    header("Location: ../View/AdminDash/users.php?msg=deleted");
} else {
    echo "Delete failed!";
}
