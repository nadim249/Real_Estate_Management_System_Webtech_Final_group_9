<?php

class DatabaseConnection {

    function openConnection() {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "real_estate_db";

        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

        if ($connection->connect_error) {
            die("Could not connect database " . $connection->connect_error);
        }

        return $connection;
    }

    function signUp($connection, $tableName, $full_name, $email, $phone, $password) {
        $sql = "INSERT INTO $tableName (full_name, email, phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("ssss", $full_name, $email, $phone, $password);
        return $stmt->execute();
    }

    function signin($connection, $tableName, $email, $password) {
        $sql = "SELECT * FROM $tableName WHERE email = ? AND password = ?";
        $stmt = $connection->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        return $stmt->get_result();
    }

    function checkExistingUser($connection, $tableName, $email) {
        $sql = "SELECT * FROM $tableName WHERE email = ?";
        $stmt = $connection->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();
    }

    function closeConnection($connection) {
        if ($connection) {
            $connection->close();
        }
    }

    public function getUserViews($userId) {
    $conn = $this->openConnection();
    $stmt = $conn->prepare("SELECT * FROM viewings WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $views = [];
    while ($row = $result->fetch_assoc()) {
        $views[] = $row;
    }
    return $views;
}

public function getUserTransactions($userId) {
    $conn = $this->openConnection();
    $stmt = $conn->prepare("SELECT * FROM transactions WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $transactions = [];
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
    return $transactions;
}

}
?>
