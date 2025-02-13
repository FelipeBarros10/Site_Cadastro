<?php

require_once __DIR__ . "/../connect/connectionBd.php";

function createNewProduct($productInformations, $infoUploadImage) {
 
  if (!empty($infoUploadImage)) {
    $imageUniqueName = imageUniqueName($infoUploadImage);


    if (!isset($imageUniqueName)) {
      return $errors["moveFile"] = "Erro no upload da imagem";
    }
  }

  if($productInformations["price"] != "" && $productInformations["cost"] != ""){
    $explodingStrPrice = array(explode("R$", $productInformations["price"]), explode("R$", $productInformations["cost"]));
    
    $gettingPriceStr = $explodingStrPrice[0][1];
    $gettingCostStr = $explodingStrPrice[1][1];
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
    $queryResult = dbQuery($query, $values);

    if(mysqli_num_rows($queryResult) > 0){
      $row = mysqli_fetch_assoc($queryResult);
      $categorieId = $row["ID"];
    }
  }


  $insertProducts = insertDbProducts($productInformations["productName"], $productInformations["quantity"], $gettingPriceStr, $_SESSION["userId"], $categorieId, $imageUniqueName, $gettingCostStr);

  if (isset($insertProducts)){
    $success = "Produto Cadastrado";
    return ['valid' => $success];

  } else {
    return $errors["insertDb"] = "Erro na conexão com o banco de dados";
  }

}

function public_path($path = '') {
  return realpath(__DIR__ . '/' . $path);
}


function imageUniqueName($infoUploadImage) {

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



function insertDbCategories($categorie) {

  $query = "INSERT INTO CATEGORIAS (NOME) VALUES (?)";

  $values = $categorie;

  $categorieInsert = dbQuery($query, $values);


  if ($categorieInsert) {
    return true;
  } else {
    return false;
  }
}

function comparingCategorieName($query, $values) {
  $queryCommand = $query;

  if($values){
    if(is_string($values)){
      $queryResult = dbQuery($queryCommand, $values);

      $values = strtolower(removeAccents($values));
  
      if (mysqli_num_rows($queryResult) > 0) {
      
        while ($row = mysqli_fetch_assoc($queryResult)) {
          
          $rowValue = strtolower(removeAccents($row["NOME"]));
          if ($values == $rowValue) {
            return true;
          }
        }
      } 
  
      return false;
    }

    $queryResult = dbQuery($queryCommand, $values);

    if($queryResult){
      return true;
    }

    return false;
    
  }
  

  
  
}


function removeAccents($string) {
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

function insertDbProducts ($productName, $quantity, $price, $userId, $categorieId, $image, $cost) {

  $values = array($productName, $quantity, $price, $userId, $categorieId, $image, $cost);

  $query = "INSERT INTO produtos SET 
    NOME = ?,  
    QUANTIDADE_ESTOQUE = ?,  
    PRECO = ?,  
    ID_USUARIO = ?,  
    ID_CATEGORIAS = ?,  
    IMAGENS = ?,  
    CUSTO = ?;";

  $insertProducts = dbQuery($query, $values);

  return $insertProducts;
  
  
}

function deleteProductAtDb ($productId){
  $query = "DELETE FROM produtos WHERE ID = ?";
  $values = $productId["product_id"];
  $deletingTheProduct = dbQuery($query, $values);

  if($deletingTheProduct){
    return true;
  } else {
    return false;
  }
}

function updateProduct($productId, $productInformations, $infoUploadImage = NULL){
  $queryProductsSelect = "SELECT * FROM produtos WHERE id = ?";
  $values = $productId;
  $queryResult = dbQuery($queryProductsSelect, $values);

  if(mysqli_num_rows($queryResult) > 0){
    $row = mysqli_fetch_assoc($queryResult);
    $updates = [];
    $updatesValues = [];

    if($productInformations["selectCategory"] != ""){

      $query = "SELECT ID FROM categorias WHERE NOME = ?";
    
      $values = [$productInformations["selectCategory"]];
    
      $categoryResult = dbQuery($query, $values);
    
      if(mysqli_num_rows($categoryResult) > 0){
        $cateoryRow = mysqli_fetch_assoc($categoryResult);
        $categoryId = $cateoryRow["ID"];        

        if($categoryId != $row["ID_CATEGORIAS"]){
          $updates[] = "ID_CATEGORIAS = ?";
          $updatesValues[] = $categoryId;

        }
      }
  
    }

    return false;
  }
  
  


  

  //TODO: CASO "NEW CATEGORY" ESTEJA PREECHIDO, FAZER O INSERT NA TABELA CATEGORIAS E COLOCAR NO ARRAY DE ALTERAÇÕES E DE VALORES QUE IRÃO PARA A QUERY DINÂMICA

  //TODO: FAZER O RESTANTE DAS COMPARAÇÕES, NOME, VALOR, ETC. E COLOCAR NO ARRAY DE ALTERAÇÕES E DE VALORES QUE IRÃO PARA A QUERY DINÂMICA



}