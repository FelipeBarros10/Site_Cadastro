<?php
session_start();
include_once '../model/usuarios.php';
include_once '../validations/loginValidate.php';

if(isset($_POST)){
  if (isset($_POST)) {
    $userInformation = $_POST;
    login($userInformation);
  }
}

function login($userInformation) {
  $userLoginValidating = loginValidate($userInformation);


  if(isset($userLoginValidating['invalid'])){
     $_SESSION['errorsLogin'] = $userLoginValidating['invalid'];
    
     header('Location: ../index.php');
     exit();
  } else {
    if(isset($userLoginValidating['valid'])){
   
      header('Location: ../views/mainPage.php');
      exit();
    } 
  }
  return;
}


?>
