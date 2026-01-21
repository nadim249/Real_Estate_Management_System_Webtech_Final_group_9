<?php
session_start();
require_once "../../Model/DatabaseConnection.php";
require_once "../../Model/propertisemodel.php";

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: ../../View/Auth/login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../../View/AdminDash/propertiesdata.php");
    exit;
}

$propertyId = intval($_GET['id']);
$db = new DatabaseConnection();
$conn = $db->openConnection();

$propertyModel = new PropertiseModel($conn);

if (!$propertyModel->exists($propertyId)) {
    $_SESSION['propertyDeleteErr'] = "Property not found!";
    header("Location: ../../View/AdminDash/propertiesdata.php");
    exit;
}
if ($propertyModel->deleteProperty($propertyId)) {
    header("Location: ../../View/AdminDash/propertiesdata.php?msg=deleted");
} else {
    $_SESSION['propertyDeleteErr'] = "Delete failed!";
    header("Location: ../../View/AdminDash/propertiesdata.php");
}

$conn->close();
exit;
?>