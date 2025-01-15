<?php 


function registerProductValidate ($productInformations){

  foreach ($productInformations as $keyIndex => $value){

    $productInformations[$keyIndex] = trim($productInformations[$keyIndex]);
  }

  if(empty($productInformations["productName"])){

  }

}