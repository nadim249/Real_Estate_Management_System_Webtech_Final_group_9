<?php
include "../Model/DatabaseConnection.php";

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

$fullname = trim($_REQUEST["fullname"] ?? "");
$email    = trim($_REQUEST["email"] ?? "");
$phone    = trim($_REQUEST["phone"] ?? "");
$password = $_REQUEST["password"] ?? "";

$errors = [];
$values = [];

// validation
if ($fullname === "") {
    $errors["fullname"] = "This is a required field";
}
if ($email === "") {
    $errors["email"] = "This is a required field";
}
if ($phone === "") {
    $errors["phone"] = "This is a required field";
}
if ($password === "") {
    $errors["password"] = "Password field is required";
}

// keep old values (so form can re-fill if you want)
$values["fullname"] = $fullname;
$values["email"] = $email;
$values["phone"] = $phone;

if (count($errors) > 0) {
    $_SESSION["fullnameErr"] = $errors["fullname"] ?? "";
    $_SESSION["emailErr"]    = $errors["email"] ?? "";
    $_SESSION["phoneErr"]    = $errors["phone"] ?? "";
    $_SESSION["passwordErr"] = $errors["password"] ?? "";

    $_SESSION["previousValues"] = $values;

    header("Location: ../View/signup.php");
    exit;
}

// DB work
$db = new DatabaseConnection();
$connection = $db->openConnection();

// check existing email
$existing = $db->checkExistingUser($connection, "buyers", $email);
if ($existing && $existing->num_rows > 0) {
    $_SESSION["emailErr"] = "Email Already Used";
    $_SESSION["previousValues"] = $values;

    $db->closeConnection($connection);
    header("Location: ../View/signup.php");
    exit;
}

// signup (insert)
$result = $db->signUp($connection, "buyers", $fullname, $email, $phone, $password);

$db->closeConnection($connection);

if ($result) {
    header("Location: ../View/login.php");
    exit;
} else {
    $_SESSION["signUpErr"] = "Failed to signup";
    $_SESSION["previousValues"] = $values;
    header("Location: ../View/signup.php");
    exit;
}
?>
