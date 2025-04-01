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
  }

  registerProduct($productInformations);
}

function registerProduct ($productInformations, $infoUploadImage = null){
  if(isset($productId) && isset($productInformations) && $infoUploadImage['name'] != ''){
    $registerProductValidating = productInformationValidate($productInformations, $infoUploadImage);

  } else {
    $registerProductValidating = productInformationValidate($productInformations);
  }
  
  if(isset($registerProductValidating['invalid'])){
    $_SESSION['errorsRegisterProduct'] = $registerProductValidating['invalid'];

    header('Location: ../views/registerPage.php');
    exit();
  } else {
    
    if(isset($_FILES["file"])){
      $infoUploadImage = $_FILES["file"];
    }

    $createNewProduct = createNewProduct($registerProductValidating, $infoUploadImage);

    if(isset($createNewProduct['valid'])){
      header("Location: ../views/mainPage.php");
      exit();
    }
    
  }

}