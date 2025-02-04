<?php
#startando a sessão
session_start();

#Incluindo os arquivos necessários
require_once __DIR__  . '/../model/products.php';

if(isset($_POST)){

  $productId = $_POST;

  deleteProduct($productId);
}


function deleteProduct ($productId){
  if(isset($productId)){
    $productDeletion = deleteProductAtDb($productId);
  }

  if(isset($productDeletion)){
    header("Location: ../views/mainPage.php");
    exit();
  }

}

