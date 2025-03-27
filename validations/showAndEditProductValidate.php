<?php

require_once __DIR__ . "/../model/products.php";

function productInformationValidate($productInformations, $infoUploadImage = null)
{

  foreach ($productInformations as $keyIndex => $value) {

    $productInformations[$keyIndex] = trim($productInformations[$keyIndex]);
  }

  if(isset($infoUploadImage)){
    $extractingImageType = implode(explode("image/", $infoUploadImage["type"]));
    
    if(!preg_match('/jpeg|jpg|png|webp/', $extractingImageType)){
      $errors["invalidImage"] = "Tipo da imagem inválido";
    }
  }

  if (empty($productInformations["productName"])) {
    $errors["productNameEmpty"] = "Informe o nome do produto";
  }


  if (empty($productInformations["price"])) {
    $errors["priceEmpty"] = "Informe o valor do produto";
  } else if ($productInformations["price"] === 0) {
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
  } else if (!empty($productInformations["selectCategory"]) && !empty($productInformations["newCategory"])){
    $errors["bothFilled"] = "Selecione uma categoria existente ou registre uma nova";
  }

  if (isset($errors)) {
    return ['invalid' => $errors];
  } else {
    return $productInformations;
  }
}

