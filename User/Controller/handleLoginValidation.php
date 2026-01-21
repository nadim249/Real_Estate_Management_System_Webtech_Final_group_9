<?php 
include "../Model/DatabaseConnection.php";

session_start();

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

$errors = [];
$values = [];

if(!$email){
    $errors["email"] = "This is a required field";
}
if(!$password){
    $errors["password"] = "Password field is required";
}

if(count($errors) > 0){
    if($errors["email"] != ""){
        $_SESSION["emailErr"] = $errors["email"];
    }else{
        unset($_SESSION["emailErr"]);
    }
    if($errors["password"] != ""){
        $_SESSION["passwordErr"] = $errors["password"];
    }else{
        unset($_SESSION["passwordErr"]);
    }
$values["email"] = $email;

$_SESSION["previousValues"] = $values;

Header("Location: ../View/LogIn.php");

}else{
    $db = new DatabaseConnection();
    $connection = $db->openConnection();
    $result = $db->signin($connection, "buyers", $email, $password);
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
          $_SESSION["user_id"]= $user['user_id'];
        Header("Location: ../View/dashboard.php");
        $_SESSION["email"] = $email;
        $_SESSION["isLoggedIn"] = true;
      
    }else{
        $_SESSION["loginErr"] = "Email or password is invalid";
        Header("Location: ../View/LogIn.php");
    }
    
}




?>