<?php 
#startando a sessão
session_start();

#Incluindo os arquivos necessários
include_once '../model/products.php';
include_once '../validations/registerProductValidate.php';

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
      $createNewProduct = createNewProduct($registerProductValidating, $infoUploadImage);
    }
    
  }

}