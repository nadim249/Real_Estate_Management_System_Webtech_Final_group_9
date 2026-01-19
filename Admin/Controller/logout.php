<?php 
session_start();

session_destroy();
setcookie("email", "", time() - 3600, "/");

Header("Location: ../View/Auth/login.php");

?>