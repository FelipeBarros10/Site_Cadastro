<?php

require_once __DIR__ . "/../model/products.php";

function registerProductValidate($productInformations, $infoUploadImage = null)
{

  foreach ($productInformations as $keyIndex => $value) {

    $productInformations[$keyIndex] = trim($productInformations[$keyIndex]);
  }

  if(isset($infoUploadImage)){
    $extractingImageType = implode(explode("image/", $infoUploadImage["type"]));
    
    if(!preg_match('/jpeg|jpg|webp|png/', $extractingImageType)){
      $errors["invalidImage"] = "Tipo da imagem inválido";
    }
  }

  if (empty($productInformations["productName"])) {
    $errors["productNameEmpty"] = "Informe o nome do produto";
  }

   $price = implode(explode("R$ ", $productInformations["price"]));
    

  if ($price === "R$") {
    $errors["priceEmpty"] = "Informe o valor do produto";
  } 
  
  if ($price === "0,00") {
    $errors["priceEqualZero"] = "O valor do produto deve ser maior que 0";
  }

  $cost = implode(explode("R$ ", $productInformations["cost"]));

  if($cost === "R$"){
    $errors["emptyCost"] = "Informe o custo do produto";
  }

  if ($cost == 0) {
    $errors["costEqualZero"] = "O valor do produto deve ser maior que 0";
  }

  if (empty($productInformations["quantity"])) {
    $errors["quantityEmpty"] = "Informe a quantidade do produto";
  }

  if (empty($productInformations["selectCategory"]) && empty($productInformations["newCategory"])) {
    $errors["selectCategory"] = "Selecione a categoria do produto ou registre uma nova abaixo";
  }

  if (empty($productInformations["selectCategory"]) && $productInformations["newCategory"] != "") {
    $query = "SELECT NOME FROM categorias WHERE NOME = ?";
    $values = $productInformations["newCategory"];
    $categorieExist = comparingCategoryName($query, $values);


    if($categorieExist == true){
      $errors["categorieAlreadyExist"] = "Essa categoria já existe, selecione-a no campo acima";
    }
  }

  if (isset($errors)) {
    return ['invalid' => $errors];
  } else {
    return $productInformations;
  }
}
