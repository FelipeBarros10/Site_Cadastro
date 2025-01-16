<?php

function registerProductValidate($productInformations)
{

  foreach ($productInformations as $keyIndex => $value) {

    $productInformations[$keyIndex] = trim($productInformations[$keyIndex]);
  }

  if (empty($productInformations["productName"])) {
    $errors["productNameEmpty"] = "Informe o nome do produto";
  }

  if (!empty($productInformations["file"])) {
    $separator = explode(".", $productInformations["file"]);

    if (!preg_match('/^\(jpeg|png|gif|bmp|jpg\)$/', $separator[1])) {
      $errors["file"] = "Verifique a extensão. Extesões permitidas: (jpeg|png|gif|bmp|jpg)";
    }
  }


  if (empty($productInformations["price"])) {
    $errors["priceEmpty"] = "Informe o valor do produto";
  } else if ($productInformations["price"] === 0) {
    $errors["priceEqualZero"] = "O valor do produto deve ser maior que 0";
  }

  if (empty($productInformations["quantity"])) {
    $errors["quantityEmpty"] = "Informe o valor do produto";
  } else if ($productInformations["quantity"] === 0) {
    $errors["quantityEqualZero"] = "A quantidade do produto deve ser maior que 0";
  }

  if (empty($productInformations["selectCategory"])) {
    if (empty($productInformations["newCategory"])) {
      $errors["selectCategory"] = "Selecione a categoria do produto ou registre uma nova abaixo";
    }
  }

  if (isset($errors)) {
    return ['invalid' => $errors];
  } else {
    return $productInformations;
  }
}
