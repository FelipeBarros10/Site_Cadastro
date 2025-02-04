<?php 
#startando a sessão
session_start();

#Incluindo os arquivos necessários
require_once __DIR__  . '/../model/products.php';
require_once __DIR__  . '/../validations/showAndUpdateProductValidate.php';


if(isset($_POST)){

  $productId = $_SESSION["currentProductId"];
  $productInformations = $_POST;

  var_dump($productInformations, $productId);
}


function updateProduct ($productId, $productInformations){
  if(isset($productId) && isset($productInformations)){
    $productInformationValidating = productInformationValidate($productInformations);

    if(isset($productInformationValidating['valid'])){
      $updatingProduct = updateProduct($productId, $productInformations);
      header("Location: ../views/mainPage.php");
      exit();
    }
  }

  

}


