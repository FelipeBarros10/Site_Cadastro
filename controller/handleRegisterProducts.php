<?php 
#startando a sessão
session_start();

#Incluindo os arquivos necessários
require_once __DIR__  . '/../model/products.php';
require_once __DIR__  . '/../validations/registerProductValidate.php';

if(isset($_POST)){

  $productInformations = $_POST;

  registerProduct($productInformations);
}

function registerProduct ($productInformations){
  $registerProductValidating = registerProductValidate($productInformations);

  if(isset($registerProductValidating['invalid'])){
    $_SESSION['errors'] = $registerProductValidating['invalid'];
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