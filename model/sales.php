<?php
require_once __DIR__ . "/../connect/connectionBd.php";

function checkingQuantityBeenSale($infoProductsToSale)
{
  $query = "SELECT QUANTIDADE_ESTOQUE FROM produtos WHERE ID = ?";
  $teste = [];
  foreach ($infoProductsToSale as $productSaleInfo) {
    $id = $productSaleInfo["id"];

    $resultQuantity = dbQuery($query, $id);

    if ($currentProductQuantity = mysqli_fetch_assoc($resultQuantity)) {
      if ($currentProductQuantity < $productSaleInfo["quantidade"]) {
        return false;
      }
    }

    $saleProductQuantity = $productSaleInfo["quantidade"];
    deductSalesQuantity($id, $saleProductQuantity, $currentProductQuantity);
  }

  return true;
}

function deductSalesQuantity($idProduct, $saleProductQuantity)
{
  $query = "UPDATE produtos SET QUANTIDADE_ESTOQUE = QUANTIDADE_ESTOQUE - ? WHERE ID = ?";
  $values = [$saleProductQuantity, $idProduct];

  $deductionResult = dbQuery($query, $values);

  if (isset($deductionResult)) {
    return true;
  }
}
