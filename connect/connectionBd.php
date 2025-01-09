<?php 

  function connectDb (){
    $hostName = "localhost";
    $userHost = "root";
    $password = "";
    $nameDb = "site_register";

    $conn = mysqli_connect($hostName, $userHost, $password, $nameDb);

    if($conn){
      return $conn;
    } else {
      echo "erro no banco";
      return;
    }
   
  }

  function dbQuery ($conn, $query){
      if($query != ''){
        $queryResult = mysqli_query($conn, $query);
        return $queryResult;
      } else {
        echo "Erro na query";
        return;
    }
  }



?>