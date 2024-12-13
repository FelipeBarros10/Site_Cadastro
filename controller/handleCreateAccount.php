<?php
session_start();

include_once '../model/usuarios.php';
include_once '../validations/createAccountValidate.php';

if (isset($_POST)) {
  $userInformation = $_POST;
  register($userInformation);
}

function register($userInformation) {
  $userInformationValidating = registerValidate($userInformation);

  if(isset($userInformationValidating['invalid'])){
     $_SESSION['errors'] = $userInformationValidating['invalid'];
    
     header('Location: ../index.php');
     exit();
  } else {
    $userCreated = createUser($userInformation);
    if(isset($userCreated)){
      header('Location: ../views/mainPage.php');
    } 
  }
  return;
}
