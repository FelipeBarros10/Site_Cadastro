<?php 
#startando a sessão
session_start();

#Incluindo os arquivos necessários
include_once '../model/usuarios.php';
include_once '../validations/resgisterProductValidate.php';

if(isset($_POST)){

  $productInformations = $_POST;

  registerProduct($productInformations);
}

var_dump($productInformations);



function registerProduct ($productInformations){
  $registerProductValidating = registerProductValidate($productInformations);

}