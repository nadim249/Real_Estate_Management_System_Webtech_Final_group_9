<?php 
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if($isLoggedIn){
    Header("Location: dashboard.php");
}
$emailErr = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$loginErr = $_SESSION["loginErr"] ?? "";

$previousValues = $_SESSION["previousValues"] ?? [];


unset($_SESSION["previousValues"]);
unset($_SESSION["emailErr"]);
unset($_SESSION["passwordErr"]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="../Public/css/style.css" />
</head>
<body>

  <div class="page">
    <div class="card">
      <h1 class="title">Log In</h1>

      <form class="form" method="post" onsubmit="" action="../Controller/handleLoginValidation.php">
        <label class="label" for="email">Email Address</label>
        <input class="input" type="email" id="email" placeholder="example@email.com" name="email"/>
                <span class="errSpan" style="color:red;"><?php  echo $emailErr; ?></span>

        <label class="label" for="password">Password</label>
        <input class="input" type="password" id="password" placeholder="Enter password" name="password"/>
                <span class="errSpan" style="color:red;"><?php  echo $passwordErr; ?></span>

        <button class="btn" type="submit">Login</button>

        <a class="forgot" href="forget.php">Forgot Password?</a>
      </form>
    </div>
  </div>
</body>
</html>
