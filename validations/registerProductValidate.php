<?php

require_once __DIR__ . "/../model/products.php";

function registerProductValidate($productInformations)
{

  foreach ($productInformations as $keyIndex => $value) {

    $productInformations[$keyIndex] = trim($productInformations[$keyIndex]);
  }

  if (empty($productInformations["productName"])) {
    $errors["productNameEmpty"] = "Informe o nome do produto";
  }

   $price = implode(explode("R$ ", $productInformations["price"]));
    

  if ($price === "R$") {
    $errors["priceEmpty"] = "Informe o valor do produto";
  } 
  
  if ($price == 0) {
    $errors["priceEqualZero"] = "O valor do produto deve ser maior que 0";
  }

  if(empty($productInformations["cost"])){
    $errors["emptyCost"] = "Informe o custo do produto";
  }

  if (empty($productInformations["quantity"])) {
    $errors["quantityEmpty"] = "Informe a quantidade do produto";
  } else if ($productInformations["quantity"] === 0) {
    $errors["quantityEqualZero"] = "A quantidade do produto deve ser maior que 0";
  }

  if (empty($productInformations["selectCategory"])) {
    if (empty($productInformations["newCategory"])) {
      $errors["selectCategory"] = "Selecione a categoria do produto ou registre uma nova abaixo";
    } else {
      $query = "SELECT * FROM categorias";
      $values = $productInformations["newCategory"];
      $categorieExist = comparingCategoryName($query, $values);

      if($categorieExist == true){
        $errors["categorieAlreadyExist"] = "Essa categoria já existe, selecione-a no campo acima";
      }
    }
  }

  if (isset($errors)) {
    return ['invalid' => $errors];
  } else {
    return $productInformations;
  }
}
