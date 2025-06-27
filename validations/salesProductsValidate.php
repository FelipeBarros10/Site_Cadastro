<?php

require_once __DIR__ . "/../model/sales.php";

function validateSale($infoProductsToSale){
  $isAvailableToSell = checkingQuantityBeenSale($infoProductsToSale);
  
  if(!isset($isAvailableToSell)){
    $errors["exceedStock"] = "Estoque insuficiente.";
  }

  if(isset($errors)){
    return ["invalid" => $errors];
  }

  return ["valid" => "Venda concluída com sucesso."];
}
