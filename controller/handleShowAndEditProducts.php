<?php 
#startando a sessão
session_start();

#Incluindo os arquivos necessários
require_once __DIR__  . '/../model/products.php';
require_once __DIR__  . '/../validations/showAndEditProductValidate.php';


if(isset($_POST)){

  $productId = $_SESSION["currentProductId"];

  $productInformations = $_POST;

  update($productId,$productInformations);

}


function update ($productId, $productInformations){
  if(isset($productId) && isset($productInformations)){
    $productInformationValidating = productInformationValidate($productInformations);

    if(isset($productInformationValidating['invalid'])){
      $_SESSION['errors'] = $productInformationValidating['invalid'];
      
    } else{

      if(isset($_FILES["file"])){
        $infoUploadImage = $_FILES["file"];
      }

      $updatingProduct = updateProduct($productId, $productInformations, $infoUploadImage);

      if(isset($updatingProduct)){
        header("Location: ../views/mainPage.php");
        exit();
      } 
    }
  }

  

}


