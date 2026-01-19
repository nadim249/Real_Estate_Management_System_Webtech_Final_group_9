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
  <title>About EstateNexus</title>
  <link rel="stylesheet" href="../Public/css/style4.css" />
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


  <section class="about">
    <div class="box">

      <h1 class="title">About EstateNexus</h1>
      <p class="subtitle">
        We are the world's leading real estate platform. We connect buyers with sellers<br />
        seamlessly.
      </p>

      <div class="stats">
        <div class="stat">
          <h2>10k+</h2>
          <p>Properties</p>
        </div>

        <div class="stat">
          <h2>5k+</h2>
          <p>Happy Customers</p>
        </div>

        <div class="stat">
          <h2>100+</h2>
          <p>Awards</p>
        </div>
      </div>

    </div>
  </section>
</body>
</html>
