<?php 
session_start();

$emailErr = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$resetSuccess = $_SESSION["resetSuccess"] ?? "";

unset($_SESSION["emailErr"]);
unset($_SESSION["passwordErr"]);
unset($_SESSION["resetSuccess"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password</title>
  <link rel="stylesheet" href="../Public/css/style.css" />
</head>
<body>

  <div class="page">
    <div class="card">
      <h1 class="title">Reset Password</h1>

      <?php if($resetSuccess): ?>
        <div style="color:green; padding-bottom:10px;"><?php echo $resetSuccess; ?></div>
      <?php endif; ?>

      <form class="form" method="POST" action="../Controller/handleResetPassword.php">
        
        <label class="label" for="email">Email Address</label>
        <input class="input" type="email" id="email" placeholder="example@email.com" name="email" required/>
        <span class="errSpan" style="color:red;"><?php echo $emailErr; ?></span>

        <label class="label" for="password">New Password</label>
        <input class="input" type="password" id="password" placeholder="Enter new password" name="password" required/>
        <span class="errSpan" style="color:red;"><?php echo $passwordErr; ?></span>

        <button class="btn" type="submit">Reset Password</button>
      </form>

      <a class="forgot" href="login.php">Back to Login</a>
    </div>
  </div>
</body>
</html>
