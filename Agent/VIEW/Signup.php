<?php 
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if($isLoggedIn){
    Header("Location: dashboard.php");
}
$emailErr = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$signUpErr = $_SESSION["signUpErr"] ?? "";
$firstNameErr = $_SESSION["firstNameErr"] ?? "";
$lastNameErr  = $_SESSION["lastNameErr"] ?? "";


$previousValues = $_SESSION["previousValues"] ?? [];


unset($_SESSION["previousValues"]);
unset($_SESSION["emailErr"]);
unset($_SESSION["passwordErr"]);
unset($_SESSION["signUpErr"]);
unset($_SESSION["fullNameErr"]);
unset($_SESSION["phoneErr"]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>

    <link rel="stylesheet" href="../Public/CSS/styleSign.css">
</head>
<body>
    
    <div class="container">

      
        <div class="left">
            <img src="Images/homeImg.jpg" alt="Image">
        </div>

        <div class="rightpart">
            <h1>Create an Account</h1>
            <hr>
            <p>Already have an account? <a href="Login.php" style="color: white;">Login</a></p>
            <br>
            <br>
<?php if(!empty($signUpErr)) echo "<p>$signUpErr</p>"; ?>

       <form action="../CONTROLLER/SignUpValidation.php" method="POST">

  <input type="text" name="full_name" placeholder="Full Name"
         value="<?= htmlspecialchars($previousValues['full_name'] ?? '') ?>">
  <?php if(!empty($fullNameErr)) echo "<p class='error-msg'>$fullNameErr</p>"; ?>

  <input type="text" name="phone" placeholder="Phone"
         value="<?= htmlspecialchars($previousValues['phone'] ?? '') ?>">
  <?php if(!empty($phoneErr)) echo "<p class='error-msg'>$phoneErr</p>"; ?>

  <input type="email" name="email" placeholder="Email"
         value="<?= htmlspecialchars($previousValues['email'] ?? '') ?>">
  <?php if(!empty($emailErr)) echo "<p class='error-msg'>$emailErr</p>"; ?>

  <input type="password" name="password" placeholder="Password">
  <?php if(!empty($passwordErr)) echo "<p class='error-msg'>$passwordErr</p>"; ?>

  <?php if(!empty($signUpErr)) echo "<p class='error-msg'>$signUpErr</p>"; ?>

  <button type="submit" name="signup">Create Account</button>
</form>

        
           
        </div>

    </div>
</body>

</html>