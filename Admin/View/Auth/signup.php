<?php 
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if($isLoggedIn){
    Header("Location: dashboard.php");
}
$unameErr=$_SESSION["unameErr"]?? "";
$emailErr = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$repasswordErr = $_SESSION["repasswordErr"] ?? "";
$loginErr = $_SESSION["signUpErr"] ?? "";

$previousValues = $_SESSION["previousValues"] ?? [];


unset($_SESSION["previousValues"]);
unset($_SESSION["unameErr"]);
unset($_SESSION["emailErr"]);
unset($_SESSION["passwordErr"]);
unset($_SESSION["repasswordErr"]);

unset($_SESSION["signUpErr"]);
unset($_SESSION["loginErr"]);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
    <title>Sign up</title>

</head>
<body id="page-signup">
    
    <div class="signup-card">
        <div class="signup-header">
            <h2>Create Account</h2>
        </div>

        <form method="post" onsubmit="" action="../../Controller/handleSignupValidation.php">
            <div class="form-group">
                <label>User Name</label>
                <input type="text" class="signup-input" placeholder="Nabil23"  name="uname">
                <span class="errSpan"><?php  echo $unameErr; ?></span>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" class="signup-input" placeholder="nabil@example.com" id="email" name="email" onkeyup="findExistingEmail()" value="<?php echo $previousValues["email"] ?? "" ?>" >
                <span class="errSpan" style="color:red;" id="ajaxResponse"><?php  echo $emailErr; ?></span>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="signup-input" placeholder="••••••••" name="password">
                <span class="errSpan"><?php  echo $passwordErr; ?></span>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="signup-input" placeholder="••••••••" name="repassword">
                <span class="errSpan"><?php  echo $repasswordErr; ?></span>
            </div>

            <button type="submit" class="signup-btn">Register</button>
            <span class="errSpan"><?php  echo $loginErr; ?></span>

        </form>

        <div class="signup-footer">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>

        <script src="../../Controller/JS/checkmail.js"></script>

</body>
</html>