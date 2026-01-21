<?php
session_start();
require_once "../../Model/DatabaseConnection.php";
require_once "../../Model/usermodel.php";
if (!isset($_GET['id'])) {
    header("Location: ../../View/AdminDash/users.php");
    exit;
}

$userId = intval($_GET['id']);
$db = new DatabaseConnection();
$conn = $db->openConnection();

$userModel = new UserModel($conn);

if (!$userModel->exists($userId)) {
    $_SESSION['userDeleteErr'] = "User not found!";
    header("Location: ../../View/AdminDash/users.php");
    exit;
}

if ($userModel->deleteUser($userId)) {
    header("Location: ../../View/AdminDash/users.php?msg=deleted");
} else {
    $_SESSION['userDeleteErr'] = "Delete failed!";
    header("Location: ../../View/AdminDash/users.php");
}

$conn->close();
exit;