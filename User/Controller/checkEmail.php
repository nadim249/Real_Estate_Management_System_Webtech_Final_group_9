<?php
include "../Model/DatabaseConnection.php";

$email = $_POST["Email"] ?? "";
$email = trim($email);

if ($email === "") {
    echo "Email Empty";
    exit;
}

$db = new DatabaseConnection();
$connection = $db->openConnection();

$result = $db->checkExistingUser($connection, "buyers", $email);

if ($result && $result->num_rows > 0) {
    echo "Email Already Used";
} else {
    echo "Unique Email, can be used";
}

$db->closeConnection($connection);
?>
