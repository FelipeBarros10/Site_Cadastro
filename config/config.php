<?php
session_start();

if (!isset($_COOKIE["user"])) {
  setcookie("user", "",0, "/");
  if(session_destroy()){
    header("location: ../index.php");
    exit(); 
  }
  
}

?>
