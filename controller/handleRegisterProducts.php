<?php 
#startando a sessão
session_start();

#Incluindo os arquivos necessários
require_once __DIR__  . '/../model/products.php';
require_once __DIR__  . '/../validations/registerProductValidate.php';

if(isset($_POST)){

  $productInformations = $_POST;

  if(isset($_FILES['file'])){
    $infoUploadImage = $_FILES['file'];
    
    registerProduct($productInformations, $infoUploadImage);
    return true;
  }

  registerProduct($productInformations);
}

function registerProduct($productInformations, $infoUploadImage = null){

  if($infoUploadImage['name'] !== ''){
    $registerProductValidating = registerProductValidate($productInformations, $infoUploadImage);

  } else {
    $registerProductValidating = registerProductValidate($productInformations);
  }
  
  if(isset($registerProductValidating['invalid'])){
    $_SESSION['errorsRegisterProduct'] = $registerProductValidating['invalid'];

    header('Location: ../views/registerPage.php');
    exit();
  } else {
    

    $createNewProduct = createNewProduct($registerProductValidating, $infoUploadImage);

    if(isset($createNewProduct['valid'])){
      header("Location: ../views/mainPage.php");
      exit();
    }
    
  }

}