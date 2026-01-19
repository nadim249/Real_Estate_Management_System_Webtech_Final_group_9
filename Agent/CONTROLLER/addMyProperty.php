<?php
include('../MODEL/DatabaseConn.php');

if (!isset($_POST['add_property'])) {
    header("Location: ../VIEW/AddProperty.php");
    exit;
}

$property_name = trim($_POST['property_name'] ?? '');
$type          = $_POST['type'] ?? '';
$price         = (int)($_POST['price'] ?? 0);
$bedrooms      = (int)($_POST['bedrooms'] ?? 0);
$bathrooms     = (int)($_POST['bathrooms'] ?? 0);

if ($property_name === '' || ($type !== 'Sale' && $type !== 'Rent')) {
    header("Location: ../VIEW/AddProperty.php");
    exit;
}

$db = new DatabaseConn();
$conn = $db->openConnection();

$stmt = $conn->prepare("
    INSERT INTO my_properties (property_name, price, type, bedrooms, bathrooms, views, status)
    VALUES (?, ?, ?, ?, ?, 0, 'Active')
");

$stmt->bind_param("sisii", $property_name, $price, $type, $bedrooms, $bathrooms);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: ../VIEW/Properties.php");
exit;
