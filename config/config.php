<?php
session_start();

if (!isset($_COOKIE["user"])) {
  
  setcookie("user", "",0, "/");
  header("location: ../index.php");
  exit(); 
}

?>
