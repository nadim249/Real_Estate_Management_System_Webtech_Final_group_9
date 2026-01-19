
<?php
require_once "../../Model/DatabaseConnection.php";
$db = new DatabaseConnection();
$connection = $db->openConnection();

$totalUsers = $db->fetchCount($connection, "buyers");
$totalProperties = $db->fetchCount($connection, "properties");
$pendingApprovals = $db->fetchCount($connection, "properties", "*", "status='Pending'");
$totalSold = $db->fetchCount($connection, "properties", "*", "is_sold=1");
$totalSoldThisMonth = $db->fetchCount(
    $connection,
    "properties",
    "*",
    "is_sold = 1 AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())"
);
?>