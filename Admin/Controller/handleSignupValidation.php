<?php
include "../Model/DatabaseConnection.php";

error_reporting(E_ALL);
ini_set("display_error", 1);

session_start();

$username = $_REQUEST["uname"] ?? "";
$email = $_REQUEST["email"] ?? "";
$password = $_REQUEST["password"] ?? "";
$repassword = $_REQUEST["repassword"] ?? "";
$question = $_POST['sec_question']??"";
$answer = $_POST['sec_answer']??"";

$errors = [];
$values = [];

if (!$username) {
    $errors["username"] = "Username is required field";
}

if (!$email) {
    $errors["email"] = "Email is a required field";
}
if (!$password) {
    $errors["password"] = "Password field is required";
}
if (!$repassword) {
    $errors["repassword"] = "Confirm Password field is required";
}

if(!$question || !$answer){
    $errors["qanswer"]="Secqurity que and ans required";
}

if ($password && $repassword && $password !== $repassword) {
    $errors["repassword"] = "Passwords do not match";
}

if (count($errors) > 0) {
    if ($errors["username"] != "") {
        $_SESSION["unameErr"] = $errors["username"];
    } else {
        unset($_SESSION["unameErr"]);
    }

    if ($errors["email"] != "") {
        $_SESSION["emailErr"] = $errors["email"];
    } else {
        unset($_SESSION["emailErr"]);
    }

      if ( $errors["qanswer"] != "") {
        $_SESSION["qansErr"] = $errors["qanswer"];
    } else {
        unset($_SESSION["qansErr"]);
    }
    

    if ($errors["password"] != "") {
        $_SESSION["passwordErr"] = $errors["password"];
    } else {
        unset($_SESSION["passwordErr"]);
    }

    if ($errors["repassword"] != "") {
        $_SESSION["repasswordErr"] = $errors["repassword"];
    } else {
        unset($_SESSION["repasswordErr"]);
    }

    $values["email"] = $email;
    $values["username"] = $username;

    $_SESSION["previousValues"] = $values;

    Header("Location: ../View/Auth/signup.php");
} else {
    $db = new DatabaseConnection();
    $connection = $db->openConnection();

    $result = $db->signUp($connection, "admins", $username, $email, $password,$question, $answer);
    if ($result) {
        Header("Location: ../View/Auth/login.php");
    } else {
        $_SESSION["signUpErr"] = "Failed to signup";
        Header("Location: ../View/Auth/signup.php");
    }
}
