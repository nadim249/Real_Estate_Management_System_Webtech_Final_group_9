<?php
session_start();
require_once "../Model/DatabaseConnection.php";

$q = $_GET['q'] ?? '';
if ($q) {
    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $sql = "SELECT property_id, title FROM properties WHERE (title LIKE ? OR location LIKE ? OR type LIKE ?) AND status = 'Active' LIMIT 5";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $q . "%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $properties = [];
    while ($row = $result->fetch_assoc()) {
        $properties[] = $row;
    }

    echo json_encode($properties);
} else {
    echo json_encode([]);
}
?>
