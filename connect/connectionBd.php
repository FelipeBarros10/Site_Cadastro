<?php

use function PHPSTORM_META\type;

function connectDb()
{
  $hostName = "localhost";
  $userHost = "root";
  $password = "";
  $nameDb = "site_register";

  $conn = mysqli_connect($hostName, $userHost, $password, $nameDb);

  if ($conn) {
    return $conn;
  } else {
    echo "erro no banco";
    return;
  }
}



function dbQueryInsert($conn, $query, array $values)
{

  if ($query != '') {

    if ($values) {

      $stmt = mysqli_prepare($conn, $query);

      if (isset($stmt)) {

        $typeParam = [];

        foreach ($values as $value) {
          if (is_string($value)) {
            $typeParam[] = "s";
          } else if (is_int($value)) {
            $typeParam[] = "i";
          } else {
            $typeParam[] = "d";
          }
        }

        $typeParamToStr = implode($typeParam);

        $bindParam = mysqli_stmt_bind_param($stmt, $typeParamToStr, ...$values);

        if (isset($bindParam)) {
          $queryResult = mysqli_stmt_execute($stmt);
          return $queryResult;
        }
      }
    };

  } else {
    return false;
  }
}


function dbQuerySelect ($conn, $query) {
  if ($query != '') {
    $queryResult = mysqli_query($conn, $query);
    return $queryResult;
  }  else{
    return false;
  }
}
