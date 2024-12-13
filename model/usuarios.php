<?php

//Incluindo a conexão com o BD
require_once '../connect/connectionBd.php';


function createUser($userInformation) {
  $conn = connectDb();

  foreach($userInformation as $keyIndex => $userContent){
    if($keyIndex == 'name' || $keyIndex == 'email' || $keyIndex == 'password'){
      $name = $userInformation['name'];
      $email = $userInformation['email'];
      $password = $userInformation['password'];
    }
  }
  
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $queryInsert = 'INSERT INTO CADASTRO_USUARIOS (NOME, EMAIL, SENHA) VALUES (?, ?, ?)';

    if ($prepareSql = $conn->prepare($queryInsert)) {
      $prepareSql->bind_param("sss", $name, $email, $hashedPassword);

      if ($prepareSql->execute()) {
        return true;
      } else {
        return false;
      }
    }
}

function validatingLogin() {

}


?>