<?php

class DatabaseConnection
{
    function openConnection()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "real_estate_db";

        $connection  = new mysqli($db_host, $db_user, $db_password, $db_name);
        if ($connection->connect_error) {
            die("Could not connect database " . $connection->connect_error);
        }
        return $connection;
    }

    function signUp($connection, $tableName, $username, $email, $password, $question, $answer)
    {
        $sql = "INSERT INTO " . $tableName . " (username, email, password,security_question, security_answer) VALUES (?, ?, ?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssss", $username, $email, $password, $question, $answer);
        $result = $stmt->execute();
        return $result;
    }

    function signin($connection, $tableName, $email, $password)
    {
        $sql = "SELECT * FROM " . $tableName . " WHERE email='" . $email . "' AND password='" . $password . "'";
        $result = $connection->query($sql);
        return $result;
    }


    function checkExistingUser($connection, $tableName, $email)
    {
        $sql = "SELECT * FROM " . $tableName . " WHERE email='" . $email . "'";
        $result = $connection->query($sql);
        return $result;
    }




    //Dashboard
        function getRecentProperties($connection, $limit = 5)
    {
        $sql = "
            SELECT p.title, p.price, p.status, a.full_name AS agent_name
            FROM properties p
            LEFT JOIN agents a ON p.agent_id = a.agent_id
            ORDER BY p.created_at DESC
            LIMIT $limit
        ";
        return $connection->query($sql);
    }

        function fetchCount($connection, $tableName, $column = "*", $condition = "")
    {
        $sql = "SELECT COUNT($column) as total FROM $tableName";
        if ($condition != "") {
            $sql .= " WHERE $condition";
        }

        $result = $connection->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }

    
    function closeConnection($connection)
    {
        $connection->close();
    }
}
