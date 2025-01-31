<?php
#startando a sessão
session_start();

if($_POST){
  if($_COOKIE["user"]){

    $deletingCookie = setcookie("user", "", time() - 3600, "/");

    if($deletingCookie){
      session_destroy();
      header("Location: ../index.php");
    }

  }
}