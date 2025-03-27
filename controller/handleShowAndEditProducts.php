<?php 
#startando a sessão
session_start();

#Incluindo os arquivos necessários
require_once __DIR__  . '/../model/products.php';
require_once __DIR__  . '/../validations/showAndEditProductValidate.php';


if(isset($_POST)){

  $productId = $_SESSION["currentProductId"];

  $productInformations = $_POST;

  
  if(isset($_FILES["file"])){
    $infoUploadImage = $_FILES["file"];
    
    update($productId,$productInformations, $infoUploadImage);
  }

  update($productId,$productInformations);

}


function update ($productId, $productInformations, $infoUploadImage = null){
  if(isset($productId) && isset($productInformations) && isset($infoUploadImage)){
    $productInformationValidating = productInformationValidate($productInformations, $infoUploadImage);

    return var_dump($productInformationValidating);
    
  } else {
    $productInformationValidating = productInformationValidate($productInformations);
  }

  if(isset($productInformationValidating['invalid'])){
    $_SESSION['errorsShowAndEditProducts'] = $productInformationValidating['invalid'];

    header("Location: ../views/showProducts.php?id={$_SESSION["productId"]}");
    exit();
  } else{


    $updatingProduct = updateProduct($productId, $productInformations, $infoUploadImage);

    if(isset($updatingProduct)){
      header("Location: ../views/mainPage.php");
      exit();
    } 
  }

}


