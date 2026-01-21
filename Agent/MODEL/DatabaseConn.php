<?php 

class DatabaseConn{
    function openConnection(){
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "estate_us";

        $connection  = new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connection->connect_error){
            die("Could not connect database ".$connection->connect_error);
        }
        return $connection;
    }

 function signUp($connection, $tableName, $first_name, $last_name, $email, $password){
    $sql = "INSERT INTO ".$tableName." (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);
    return $stmt->execute();
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
    
    function InsertData($connection,$table,$email, $password)
    {
        $sql = "INSERT INTO users (email,password) VALUES(?,?)";
        $stmt=$connection->prepare($sql); 
        $stmt->bind_param("ss",$email,$password);
        $result = $stmt->execute();
        return $result;
    
    }
    


function checkExistingAgentEmail($connection, $email){
    $sql = "SELECT agent_id FROM agents WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result();
}


function signUpAgent($connection, $full_name, $email, $phone, $password){
    $sql = "INSERT INTO agents (full_name, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $full_name, $email, $phone, $password);
    return $stmt->execute();
}

    function closeConnection($connection){
        $connection->close();
    }
   
}

    ?>