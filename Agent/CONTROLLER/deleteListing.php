<?php
include('../MODEL/DatabaseConn.php');

if(!isset($_POST['id'])){
    header("Location: ../VIEW/Properties.php");
    exit;
}

$property_id = (int)$_POST['id'];

$db = new DatabaseConn();
$conn = $db->openConnection();

$stmt = $conn->prepare("DELETE FROM properties WHERE property_id = ?");
$stmt->bind_param("i", $property_id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: ../VIEW/Properties.php");
exit;

?>

