<?php
session_start();

require_once __DIR__ . "/../validations/salesProductsValidate.php";

$input = file_get_contents("php://input");
if(isset($input)){

  $saledProductsInfo = json_decode($input,true);

  saleProducts($saledProductsInfo);
}

function saleProducts($saledProductsInfo){
  $saleProductsValidating = validateSale($saledProductsInfo);
  
  if(isset($saleProductsValidating["invalid"])){
    $_SESSION["errorSaleProducts"] = $saleProductsValidating["invalid"];

    echo json_encode(["status" => "invalid", "data" => $saleProductsValidating["invalid"]]);
  } else {
    echo json_encode(["status" => "ok", "data" => $saleProductsValidating["valid"]]);
  }
}


