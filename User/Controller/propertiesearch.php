<?php

$q = $_GET['q'] ?? '';
$q = trim($q);

if($q !== ''){
  $safe = $conn->real_escape_string($q);
  $sql = "SELECT * FROM properties
          WHERE status='Active'
          AND (title LIKE '%$safe%' OR location LIKE '%$safe%' OR type LIKE '%$safe%')
          ORDER BY property_id DESC";
} else {
  $sql = "SELECT * FROM properties
          WHERE status='Active'
          ORDER BY property_id DESC";
}
?>