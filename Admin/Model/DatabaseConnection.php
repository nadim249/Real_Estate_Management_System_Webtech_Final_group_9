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



    //User model Query
    function getAllBuyers($connection)
    {
        $sql = "SELECT * FROM buyers ORDER BY created_at ASC";
        $result = $connection->query($sql);
        return $result;
    }

    //agent model query
        function getAllAgents($connection)
    {
        $sql = "SELECT * FROM agents ORDER BY created_at ASC";
        return $connection->query($sql);
    }

    //Approvals
        function getPendingApprovals($connection)
    {
        $sql = "
            SELECT p.property_id, p.title, p.type, p.created_at,
                   a.full_name AS agent_name
            FROM properties p
            LEFT JOIN agents a ON p.agent_id = a.agent_id
            WHERE p.status = 'Pending'
            ORDER BY p.created_at DESC
        ";
        return $connection->query($sql);
    }

    //properties 
    function getAllProperties($connection)
    {
        $sql = "SELECT * FROM properties ORDER BY created_at DESC";
        return $connection->query($sql);
    }

    //transactions

        function getAllTransactions($connection)
    {
        $sql = "
            SELECT t.transaction_id, t.booking_amount, t.full_price, t.payment_method, t.transaction_date, t.status,
                   p.title AS property_title,
                   b.full_name AS buyer_name, 
                   a.full_name AS agent_name
            FROM transactions t
            LEFT JOIN properties p ON t.property_id = p.property_id
            LEFT JOIN buyers b ON t.user_id = b.user_id
            LEFT JOIN agents a ON t.agent_id = a.agent_id
            ORDER BY t.transaction_date DESC
        ";
        return $connection->query($sql);
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
