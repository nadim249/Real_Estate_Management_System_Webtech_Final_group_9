
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
</head>
<body>
    <body id="page-login">

    <div class="login-card">
        <div class="login-header">
            <h2>EstateMgr Admin</h2>
            <p>Please login to your account</p>
        </div>

        <form method="post" onsubmit="" action="..\..\Controller\handleLoginValidation.php">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="login-email" class="email-input" placeholder="admin@example.com" name="email" >
                <span class="errSpan" style="color:red;"><?php  echo $emailErr; ?></span>

            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="login-pass" class="pass-input" placeholder="••••••••" name="password">
                <span class="errSpan" style="color:red;"><?php  echo $passwordErr; ?></span>

            </div>

            <button type="submit" class="log-btn">Login</button>
            <span class="errSpan"><?php  echo $loginErr; ?></span>

        </form>

        <div class="login-footer">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>
</body>
</html>