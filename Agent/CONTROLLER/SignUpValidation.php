<?php
include "../MODEL/DatabaseConn.php";

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../VIEW/Signup.php");
    exit;
}

$full_name = trim($_POST["full_name"] ?? "");
$phone     = trim($_POST["phone"] ?? "");
$email     = trim($_POST["email"] ?? "");
$password  = trim($_POST["password"] ?? "");

$errors = [];
$values = [
    "full_name" => $full_name,
    "phone"     => $phone,
    "email"     => $email
];

if ($full_name === "") $errors["full_name"] = "Full name is required";
if ($phone === "")     $errors["phone"]     = "Phone Number is required";

if ($email === "") {
    $errors["email"] = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Invalid email format";
}

if ($password === "") {
    $errors["password"] = "Password is required";
}


if (!empty($errors)) {
    $_SESSION["fullNameErr"] = $errors["full_name"] ?? "";
    $_SESSION["phoneErr"]    = $errors["phone"] ?? "";
    $_SESSION["emailErr"]    = $errors["email"] ?? "";
    $_SESSION["passwordErr"] = $errors["password"] ?? "";

    $_SESSION["previousValues"] = $values;

    header("Location: ../VIEW/Signup.php");
    exit;
}


$db = new DatabaseConn();
$connection = $db->openConnection();


$existing = $db->checkExistingAgentEmail($connection, $email);
if ($existing && $existing->num_rows > 0) {
    $_SESSION["signUpErr"] = "Email already exists";
    $_SESSION["previousValues"] = $values;

    header("Location: ../VIEW/Signup.php");
    exit;
}


$result = $db->signUpAgent($connection, $full_name, $email, $phone, $password);

if ($result) {
    $_SESSION["successMsg"] = "Agent account created successfully. Please login.";
    header("Location: ../VIEW/Login.php");
    exit;
} else {
    $_SESSION["signUpErr"] = "Failed to signup";
    $_SESSION["previousValues"] = $values;
    header("Location: ../VIEW/Signup.php");
    exit;
}
