
<?php 
include "../MODEL/DatabaseConn.php";

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

$first_name = $_POST["first_name"] ?? "";
$last_name  = $_POST["last_name"] ?? "";
$email      = $_POST["email"] ?? "";
$password   = $_POST["password"] ?? "";


$errors = [];
$values = [];
if(!$first_name){ $errors["first_name"] = "First name is required"; }
if(!$last_name){ $errors["last_name"] = "Last name is required"; }
if(!$email){ 
    $errors["email"] = "Email is required";
} 
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors["email"] = "Invalid email format";
}
if(!$password){
    $errors["password"] = "Password is required";
}


if(count($errors) > 0){
    if($errors["email"] != ""){
        $_SESSION["emailErr"] = $errors["email"];
    }else{
        unset($_SESSION["emailErr"]);
    }
   if(!empty($errors["password"])){
    $_SESSION["passwordErr"] = $errors["password"];
}else{
    unset($_SESSION["passwordErr"]);
}
if(!empty($errors["first_name"])){
    $_SESSION["firstNameErr"] = $errors["first_name"];
}else{
    unset($_SESSION["firstNameErr"]);
}

if(!empty($errors["last_name"])){
    $_SESSION["lastNameErr"] = $errors["last_name"];
}else{
    unset($_SESSION["lastNameErr"]);
}


$values["first_name"] = $first_name;
$values["last_name"]  = $last_name;
$values["email"]      = $email;


$_SESSION["previousValues"] = $values;

header("Location: ../VIEW/Signup.php");
exit;

}
else{
   
    $db = new DatabaseConn();
    $connection = $db->openConnection();
    $existing = $db->checkExistingUser($connection, "users", $email);
if($existing->num_rows > 0){
    $_SESSION["signUpErr"] = "Email already exists";
    header("Location: ../VIEW/Signup.php");
    exit;
}

$result = $db->signUp($connection, "users", $first_name, $last_name, $email, $password);
    if($result){
        $_SESSION["successMsg"] = "Account created successfully. Please login.";

header("Location: ../VIEW/Login.php");
exit;
      
    }else{
    $_SESSION["signUpErr"] = "Failed to signup: " . $connection->error;
    header("Location: ../VIEW/Signup.php");
    exit;
}

    
}

?>
