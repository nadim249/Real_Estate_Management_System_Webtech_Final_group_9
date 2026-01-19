<?php
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if ($isLoggedIn) {
    Header("Location: dashboard.php");
}
$unameErr = $_SESSION["unameErr"] ?? "";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
                <input type="text" class="signup-input" placeholder="Nabil23" name="uname">
                <span class="errSpan"><?php echo $unameErr; ?></span>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" class="signup-input" placeholder="nabil@example.com" id="email" name="email" onkeyup="findExistingEmail()" value="<?php echo $previousValues["email"] ?? "" ?>">
                <span class="errSpan" style="color:red;" id="ajaxResponse"><?php echo $emailErr; ?></span>
            </div>

            <div class="form-group">

                <label>Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" class="signup-input" placeholder="••••••••" name="password">
                    <i class="fa-solid fa-eye toggle-eye" onclick="togglePassword('password', this)"></i>
                </div>
                <span class="errSpan"><?php echo $passwordErr; ?></span>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <div class="password-wrapper">
                    <input type="password" id="cpassword" class="signup-input" placeholder="••••••••" name="repassword">
                    <i class="fa-solid fa-eye toggle-eye" onclick="togglePassword('cpassword', this)"></i>
                </div>
                <span class="errSpan"><?php echo $repasswordErr; ?></span>
            </div>

            <button type="submit" class="signup-btn">Register</button>
            <span class="errSpan"><?php echo $loginErr; ?></span>

        </form>

        <div class="signup-footer">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>

    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>


    <script src="../../Controller/JS/checkmail.js"></script>

</body>

</html>