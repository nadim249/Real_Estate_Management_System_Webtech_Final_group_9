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
unset($_SESSION["firstNameErr"]);
unset($_SESSION["lastNameErr"]);

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
            <p>Already have an account? <a href="Login.php">Login</a></p>
            <br>
            <br>
<?php if(!empty($signUpErr)) echo "<p>$signUpErr</p>"; ?>

       <form action="../CONTROLLER/SignUpValidation.php" method="POST">
  <input type="text" name="first_name" placeholder="First Name" >
  <?php if(!empty($firstNameErr)) echo "<p>$firstNameErr</p>"; ?>

  <input type="text" name="last_name" placeholder="Last Name" >
    <?php if(!empty($lastNameErr)) echo "<p>$lastNameErr</p>"; ?>
  <input type="email" name="email" placeholder="Email" >
    <?php if(!empty($emailErr)) echo "<p>$emailErr</p>"; ?>
  <input type="password" name="password" placeholder="Password" >
    <?php if(!empty($passwordErr)) echo "<p>$passwordErr</p>"; ?>
            <br>
            <br>
            <br>
            
                  <button type="submit" name="signup">Create Account</button>
</form>

        
           
        </div>

    </div>
</body>

</html>