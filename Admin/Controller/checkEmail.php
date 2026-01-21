<?php
include "../Model/DatabaseConnection.php";
$Email = "";
$Email = $_POST["Email"];

if ($Email == "") {
    echo "Email Empty";
} else {
    $db = new DatabaseConnection();
    $connection = $db->openConnection();
    $result = $db->checkExistingUser($connection, "admins", $Email);
    if ($result->num_rows > 0) {
        echo "Email Already Used";
    } else {
        echo "Unique Email, can be used";
    }
}
