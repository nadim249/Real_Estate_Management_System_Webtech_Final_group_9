<?php 

class DatabaseConnection{
    function openConnection(){
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "real_estate_db";

        $connection  = new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connection->connect_error){
            die("Could not connect database ".$connection->connect_error);
        }
        return $connection;
    }

    function signUp($connection, $tableName,$username, $email, $password){
        $sql ="INSERT INTO ".$tableName." (username, email, password) VALUES (?, ?, ?)";
        $stmt=$connection->prepare($sql); 
        $stmt->bind_param("sss",$username,$email,$password);
        $result = $stmt->execute();
        return $result;

    }
    function signin($connection, $tableName, $email, $password){
        $sql = "SELECT * FROM ".$tableName." WHERE email='".$email."' AND password='".$password."'";
        $result = $connection->query($sql);
        return $result;
    }
    

    function checkExistingUser($connection, $tableName, $email){
        $sql = "SELECT * FROM ".$tableName." WHERE email='".$email."'";
        $result = $connection->query($sql);
        return $result;
    }

    function fetchCount($connection, $tableName, $column = "*", $condition = "") {
    $sql = "SELECT COUNT($column) as total FROM $tableName";
    if ($condition != "") {
        $sql .= " WHERE $condition";
    }

    $result = $connection->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0; // return 0 if query fails
    }
}


    function closeConnection($connection){
        $connection->close();
    }
}

?>