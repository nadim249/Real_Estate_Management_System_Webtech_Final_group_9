<?php
require_once __DIR__ . "/../Model/DatabaseConnection.php";

if (!isset($_SESSION["isLoggedIn"]) && isset($_COOKIE['email'])) {
    $email = $_COOKIE['email'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $stmt = $conn->prepare("SELECT admin_id, username, email FROM admins WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION["admin_id"] = $user['admin_id'];
        $_SESSION["email"] = $user['email'];
        $_SESSION["username"] = $user['username'];
        $_SESSION["isLoggedIn"] = true;
    }
}

if (!isset($_SESSION["isLoggedIn"])) {
    header("Location: ../Auth/login.php");
    exit;
}
?>
