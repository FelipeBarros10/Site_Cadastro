<?php

require_once __DIR__ . "/../connect/connectionBd.php";

function createNewProduct($productInformations, $infoUploadImage)
{

  if (!empty($infoUploadImage)) {
    $imageUniqueName = imageUniqueName($infoUploadImage);


    if (!isset($imageUniqueName)) {
      return $errors["moveFile"] = "Erro no upload da imagem";
    }
  }

  if(isset($productInformations["price"])){
    $explodingStr = explode("R$", $productInformations["price"]);
    
    $gettingPriceStr = $explodingStr[1];
  }

  if ($productInformations["newCategory"] != "") {
    $insertDbCategories = insertDbCategories($productInformations["newCategory"]);

    if($insertDbCategories){
      $categorieId = $insertDbCategories;
    }
    
    if (!isset($insertDbCategories)) {
      return $errors["insertDb"] = "Erro na conexão com o banco de dados";
    }
  } else if ($productInformations["selectCategory"] != "") {
    $query = "SELECT ID FROM categorias WHERE NOME = ?";
    $values = $productInformations["selectCategory"];
    $queryResult = dbQuerySelect($query, $values);

    if(mysqli_num_rows($queryResult) > 0){
      $row = mysqli_fetch_assoc($queryResult);
      $categorieId = $row["ID"];
    }
  }


  $insertProducts = insertDbProducts($productInformations["productName"], $productInformations["quantity"], $gettingPriceStr, $_SESSION["userId"], $categorieId, $imageUniqueName);

  if (isset($insertProducts)){
    $success = "Produto Cadastrado";
    return ['valid' => $success];

  } else {
    return $errors["insertDb"] = "Erro na conexão com o banco de dados";
  }

}

function public_path($path = '')
{
  return realpath(__DIR__ . '/' . $path);
}


function imageUniqueName($infoUploadImage)
{
  $imageName = $infoUploadImage["name"];
  $extensionImage = pathinfo($imageName);
  $imageHashed = md5($imageName . time()) . "." . $extensionImage["extension"];

  $tmpName = $infoUploadImage["tmp_name"];

  $destinationDir = public_path("../Assets/img");

  $destinationPath = $destinationDir . "/" . $imageHashed;

  if (move_uploaded_file($tmpName, $destinationPath)) {
    return $imageHashed;
  } else {
    return false;
  }
}



function insertDbCategories($categorie)
{

  $query = "INSERT INTO CATEGORIAS (NOME) VALUES (?)";

  $values = $categorie;

  $categorieInsert = dbQueryInsert($query, $values);

  if ($categorieInsert) {
    var_dump($categorieInsert);
    return true;
  } else {
    return false;
  }
}

function checkingCategoryTable($categorie)
{
  $queryCommand = "SELECT NOME FROM CATEGORIAS";
  $queryResult = dbQuerySelect($queryCommand);
  $categorie = strtolower($categorie);

  if (mysqli_num_rows($queryResult) > 0) {
    while ($row = mysqli_fetch_assoc($queryResult)) {
      $rowValue = strtolower(removeAccents($row["NOME"]));
      if ($categorie == $rowValue) {
        return true;
      }
    }
  } else {
    return false;
  }
}

function removeAccents($string)
{
  $mapa = [


    'á' => 'a',
    'à' => 'a',
    'ã' => 'a',
    'â' => 'a',
    'ä' => 'a',
    'Á' => 'A',
    'À' => 'A',
    'Ã' => 'A',
    'Â' => 'A',
    'Ä' => 'A',
    'é' => 'e',
    'è' => 'e',
    'ê' => 'e',
    'ë' => 'e',
    'É' => 'E',
    'È' => 'E',
    'Ê' => 'E',
    'Ë' => 'E',
    'í' => 'i',
    'ì' => 'i',
    'î' => 'i',
    'ï' => 'i',
    'Í' => 'I',
    'Ì' => 'I',
    'Î' => 'I',
    'Ï' => 'I',
    'ó' => 'o',
    'ò' => 'o',
    'õ' => 'o',
    'ô' => 'o',
    'ö' => 'o',
    'Ó' => 'O',
    'Ò' => 'O',
    'Õ' => 'O',
    'Ô' => 'O',
    'Ö' => 'O',
    'ú' => 'u',
    'ù' => 'u',
    'û' => 'u',
    'ü' => 'u',
    'Ú' => 'U',
    'Ù' => 'U',
    'Û' => 'U',
    'Ü' => 'U',
    'ç' => 'c',
    'Ç' => 'C',
    'ñ' => 'n',
    'Ñ' => 'N'
  ];
  return strtr($string, $mapa);
}

function insertDbProducts ($productName, $quantity, $price, $userId, $categorieId, $image) {
  $values = array($productName, $quantity, $price, $userId, $categorieId, $image);
  $query = "INSERT INTO produtos (NOME, QUANTIDADE_ESTOQUE, PRECO, ID_USUARIO, ID_CATEGORIA, IMAGENS) VALUES (?, ?, ?, ?, ?, ?)";

  $insertProducts = dbQueryInsert($query, $values);

  return $insertProducts;
  
  
}