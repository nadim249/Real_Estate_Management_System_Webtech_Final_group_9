<?php
include('../MODEL/DatabaseConn.php');

if (!isset($_POST['add_property'])) {
    header("Location: ../VIEW/AddProperty.php");
    exit;
}

$title        = trim($_POST['title'] ?? '');
$description  = trim($_POST['description'] ?? '');
$type         = $_POST['type'] ?? '';
$location     = trim($_POST['location'] ?? '');
$price        = (float)($_POST['price'] ?? 0);
$area_sqft    = (int)($_POST['area_sqft'] ?? 0);
$num_bedrooms = (int)($_POST['num_bedrooms'] ?? 0);
$num_bathrooms= (int)($_POST['num_bathrooms'] ?? 0);
$image_url    = trim($_POST['image_url'] ?? '');

$allowedTypes = ['Apartment','House','Commercial','Land'];

if ($title === '' || $location === '' || !in_array($type, $allowedTypes, true) || $price <= 0 || $area_sqft <= 0) {
    header("Location: ../VIEW/AddProperty.php");
    exit;
}

$db = new DatabaseConn();
$conn = $db->openConnection();


$agent_id = NULL;

$stmt = $conn->prepare("
  INSERT INTO properties
  (agent_id, title, description, type, location, price, area_sqft, num_bedrooms, num_bathrooms, image_url)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
  "isssssiiis",
  $agent_id, $title, $description, $type, $location,
  $price, $area_sqft, $num_bedrooms, $num_bathrooms, $image_url
);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: ../VIEW/Properties.php");
exit;
