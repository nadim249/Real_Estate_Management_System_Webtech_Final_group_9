<?php
session_start();
require_once "../../Model/DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../View/AdminDash/users.php");
    exit;
}

$userId   = intval($_POST['user_id']);
$fullName = $_POST['full_name'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$password = $_POST['password'] ?? '';

$db = new DatabaseConnection();
$conn = $db->openConnection();

if (!empty($password)) {

    // Update WITH password
    $sql = "UPDATE buyers 
            SET full_name = ?, email = ?, phone = ?, password = ?
            WHERE user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fullName, $email, $phone, $password, $userId);

} else {

    // Update WITHOUT password
    $sql = "UPDATE buyers 
            SET full_name = ?, email = ?, phone = ?
            WHERE user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $fullName, $email, $phone, $userId);
}

if ($stmt->execute()) {
    header("Location: ../../View/AdminDash/users.php?msg=updated");
} else {
    echo "Update failed!";
}

$stmt->close();
$conn->close();
