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
  $query = "DELETE FROM produtos WHERE ID = ?";
  $values = $productId["product_id"];
  $deletingTheProduct = dbQuery($query, $values);

  if(isset($deletingTheProduct)){
    header("Location: ../views/mainPage.php");
    exit();
  }

}

