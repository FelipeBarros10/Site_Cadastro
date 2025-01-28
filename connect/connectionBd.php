<?php

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


function dbQuery($query, $values = ""){

  $conn = connectDb();

  if ($query != '') {

    if ($values) {

      $stmt = mysqli_prepare($conn, $query);

      if (isset($stmt)) {

        $typeParam = [];

        if (is_array($values)) {
          foreach ($values as $value) {
            if(filter_var($values, FILTER_VALIDATE_INT)){
              $typeParam[] = "i";
            } elseif (filter_var($values, FILTER_VALIDATE_FLOAT)){
              $typeParam[] = "d";
            } else {
              $typeParam[] = "s";
            }
          }

          $typeParamToStr = implode($typeParam);

          $bindParam = mysqli_stmt_bind_param($stmt, $typeParamToStr, ...$values);
        } else {
          if(filter_var($values, FILTER_VALIDATE_INT)){
            $typeParam[] = "i";
          } elseif (filter_var($values, FILTER_VALIDATE_FLOAT)){
            $typeParam[] = "d";
          } else {
            $typeParam[] = "s";
          }

          $typeParamToStr = implode($typeParam);


          $bindParam = mysqli_stmt_bind_param($stmt, $typeParamToStr, $values);
        }

        if (isset($bindParam)) {
          $queryResult = mysqli_stmt_execute($stmt);

          if ($queryResult) {
            if(preg_match("/SELECT/", $query)){
              $result = mysqli_stmt_get_result($stmt);
              return $result;
            } elseif (preg_match("/INSERT/", $query)){
              $userId = mysqli_insert_id($conn);
              return $userId;
            } else {
              return true;
            }
            
          }
        }
      }
    } else {
      $queryResult = mysqli_query($conn, $query);
      return $queryResult;
    }
  } else {
    return false;
  }
}
