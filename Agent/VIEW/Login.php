<?php 
session_start();

$successMsg = $_SESSION["successMsg"] ?? "";
unset($_SESSION["successMsg"]);


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
unset($_SESSION["loginErr"]);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="../Public/CSS/styleLogin.css">
</head>

<body>

    <div class="container">

        <div class="image">
            <img src="Images/homeImg.jpg" alt="Image">
        </div>

        <div class="login">
          
            <h1 style="font-family:serif; font-weight:bold;font-size:60px ;">Estate-Us</h1>

            
            <div class="box">
                <h2>Login</h2>
                <?php if(!empty($loginErr)) echo "<p class='error-msg'>$loginErr</p>"; ?>


               <form action="../CONTROLLER/LoginValidation.php" method="POST">
                <input type="email" name="email" placeholder="Email" >
                <input type="password" name="password" placeholder="Password" >
                <div class="login-actions">
  <button type="submit">Login</button>
<a href="ForgetPassword.php" class="forgot-link">Forget Password?</a>

</div>
</form>

                <br>
                

                <p style="margin-top: 10px;font-size:14px;">
                    New here?
                    <a href="Signup.php" >
                  <button>Sign up</button>

                    </a>
                      <?php if(!empty($successMsg)) echo "<p class='success-msg'>$successMsg</p>"; ?>

                </p>
            </div>
        </div>

    </div>


</body>
</html>
