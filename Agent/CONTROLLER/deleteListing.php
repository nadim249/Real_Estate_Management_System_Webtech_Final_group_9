<?php
include('../MODEL/DatabaseConn.php');

if(!isset($_POST['id'])){
    header("Location: ../VIEW/Properties.php");
    exit;
}


$id = (int) $_POST['id'];

$db = new DatabaseConn();
$conn = $db->openConnection();


$stmt = $conn->prepare("DELETE FROM my_properties WHERE id = ?");
$stmt->bind_param("i", $id);

$stmt->execute();

$stmt->close();
$conn->close();


header("Location: ../VIEW/Properties.php");
exit;
