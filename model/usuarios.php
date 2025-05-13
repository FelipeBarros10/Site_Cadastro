<?php

#Incluindo a conexão com o BD
require_once __DIR__ . '/../connect/connectionBd.php';
require_once __DIR__ . '/../model/products.php';
require_once __DIR__ . '/../config/cookie.php';

#Função que cria usuário dentro do BD
function createUser($userInformation, $profileImage = "")
{


  #Laço de repetição
  foreach ($userInformation as $keyIndex => $userContent) {
    #Verifica se os campos de existem
    if ($keyIndex == 'name' || $keyIndex == 'email' || $keyIndex == 'password') {
      #Cria variáveis com cada informação
      $name = $userInformation['name'];
      $email = $userInformation['email'];
      $password = $userInformation['password'];
    }
  }

   #A senha criada, é transformada em um hash único
  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

  if (isset($profileImage)) {
    $profileImageHahsed = imageUniqueName($profileImage);


    if (isset($profileImageHahsed)) {
      #Comando SQL de insert no BD
      $queryInsert = 'INSERT INTO cadastro_usuarios SET 
        NOME = ? , 
        EMAIL = ?,
        SENHA = ?,
        IMAGEM_PERFIL = ?';

      

      $values = [$name, $email, $hashedPassword, $profileImageHahsed];

      $resultOfInsert = dbQuery($queryInsert, $values);

    } 
  } else {
      $queryInsert = 'INSERT INTO cadastro_usuarios SET 
        NOME = ?
        EMAIL = ?
        SENHA = ?';

      $values = [$name, $email, $hashedPassword];

      $resultOfInsert = dbQuery($queryInsert, $values);

      

  }
 
  #Verifica se o insert foi realizado
  if ($resultOfInsert) {
  
    $userCookie = setUserCookie("user", $resultOfInsert);

    if(isset($userCookie)){
      #Pegando o Id inserido do usuário
      $_SESSION["userId"] = $resultOfInsert;

      $success = "Bem-vindo(a)";

      return ['valid' => $success];
    }
    
  } else {
    #Se naõ, retorna false
    return false;
  }
}
