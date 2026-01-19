<?php 
session_start();

session_destroy();

Header("Location: ..\View\LogIn.php");

?>