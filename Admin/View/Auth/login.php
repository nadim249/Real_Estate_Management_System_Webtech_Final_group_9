<?php
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if ($isLoggedIn) {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>

    <body id="page-login">

        <div class="login-card">
            <div class="login-header">
                <h2>EstateMgr Admin</h2>
                <p>Please login to your account</p>
            </div>

            <form method="post" onsubmit="" action="../../Controller/handleLoginValidation.php">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" id="login-email" class="email-input" placeholder="admin@example.com" name="email">
                    <span class="errSpan" style="color:red;"><?php echo $emailErr; ?></span>

                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" class="pass-input" placeholder="••••••••" name="password">
                        <i class="fa-solid fa-eye toggle-eye" onclick="togglePassword('password', this)"></i>

                    </div>
                    <span class="errSpan" style="color:red;"><?php echo $passwordErr; ?></span>

                </div>

                <button type="submit" class="log-btn">Login</button>
                <span class="errSpan"><?php echo $loginErr; ?></span>

            </form>
            <div class="forgot-password">
                <a href="forgetpass.php">Forgot Password?</a>
            </div>

            <div class="login-footer">
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
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
    </body>

</html>