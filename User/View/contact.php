<?php
session_start();


$email = $_SESSION["email"] ??"";
$username = $_SESSION["username"] ??"";
$isLoggedIn= $_SESSION["isLoggedIn"]??"";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>
  <link rel="stylesheet" href="../Public/css/style5.css" />
    <link rel="stylesheet" href="../Public/css/style6.css" />

</head>
<body>
<?php 
if ($isLoggedIn) {
    include 'navloged.php';
} else {
    include 'nav.php';
}
?>

  <section class="contact">
    <div class="box">
      <h1 class="title">Contact Us</h1>

      <form class="form">
        <input class="input" type="text" placeholder="Name" />
        <input class="input" type="email" placeholder="Email" />
        <textarea class="textarea" placeholder="Message"></textarea>

        <button class="btn" type="submit">Send Message</button>
      </form>
    </div>
  </section>
</body>
</html>
