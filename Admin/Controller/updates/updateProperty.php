<?php
session_start();
require_once "../../Model/DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../View/AdminDash/propertiesdata.php");
    exit;
}

$propertyId = intval($_POST['property_id']);
$title       = $_POST['title'];
$description = $_POST['description'];
$type        = $_POST['type'];
$location    = $_POST['location'];
$price       = floatval($_POST['price']);
$area_sqft   = intval($_POST['area_sqft']);
$num_bedrooms = intval($_POST['num_bedrooms']);
$num_bathrooms = intval($_POST['num_bathrooms']);
$status      = $_POST['status'];
$is_sold     = isset($_POST['is_sold']) ? 1 : 0;

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "UPDATE properties SET
        title='$title',
        description='$description',
        type='$type',
        location='$location',
        price=$price,
        area_sqft=$area_sqft,
        num_bedrooms=$num_bedrooms,
        num_bathrooms=$num_bathrooms,
        status='$status',
        is_sold=$is_sold
        WHERE property_id=$propertyId";

if ($conn->query($sql)) {
    header("Location: ../../View/AdminDash/propertiesdata.php?msg=updated");
} else {
    echo "Update Failed!";
}
