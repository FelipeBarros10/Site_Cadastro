<?php
session_start();

//importar o model e o validate aqui

$input = file_get_contents('php://input');

if(isset($input)){

  $saledProductsInfo = $input;

  echo $saledProductsInfo;
}

function saleProducts($saledProductsInfo){
  $saleProductsValidating = validateSale($saledProductsInfo);
}


