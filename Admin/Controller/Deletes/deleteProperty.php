<?php
session_start();
require_once "../Model/DatabaseConnection.php";


if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: ../View/Auth/login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../View/AdminDash/propertiesdata.php");
    exit;
}

$propertyId = intval($_GET['id']);

$db = new DatabaseConnection();
$connection = $db->openConnection();

/* Delete property */
$sql = "DELETE FROM properties WHERE property_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $propertyId);
$stmt->execute();

$stmt->close();
$connection->close();

/* Redirect after delete */
header("Location: ../View/AdminDash/propertiesdata.php?msg=deleted");
exit;
?>