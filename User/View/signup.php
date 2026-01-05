<?php 
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if($isLoggedIn){
    Header("Location: dashboard.php");
}
$fullnameErr = $_SESSION["fullnameErr"] ?? "";
$emailErr    = $_SESSION["emailErr"] ?? "";
$phoneErr    = $_SESSION["phoneErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$loginErr    = $_SESSION["signUpErr"] ?? "";


$previousValues = $_SESSION["previousValues"] ?? [];


unset($_SESSION["previousValues"]);
unset($_SESSION["fullnameErr"]);
unset($_SESSION["emailErr"]);
unset($_SESSION["phoneErr"]);
unset($_SESSION["passwordErr"]);
unset($_SESSION["signUpErr"]);
unset($_SESSION["loginErr"]);


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="../Public/css/style1.css" />
</head>
<body>

  <div class="page">
    <div class="card">

      <h1 class="title">Sign Up</h1>

      <form class="form" method="post" onsubmit="" action="../Controller/handleSignupValidation.php" enctype="multipart/form-data">
        <label class="label" for="name">Full Name</label>
        <input class="input" name="fullname" type="text" id="name" placeholder="name" />

        <label class="label" for="email">Email Address</label>
        <input class="input" name="email" type="email" id="email" placeholder="example@email.com" />

        <label class="label" for="phone">Phone Number</label>
        <input class="input" name="phone" type="tel" id="phone" placeholder="+880 1XXX..." />

        <label class="label" for="password">Password</label>
        <input class="input" name="password" type="password" id="password" placeholder="Create a password" />
        <input  class="btn"  type="submit" name="signup" value="Sign Up"/> 

        <p class="bottom-text">
          Already have an account?
          <a class="link" href="#">Log in here</a>
        </p>
      </form>

    </div>
  </div>
 <script src="script.js"></script>
</body>
</html>
