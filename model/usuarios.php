<?php
session_start();

#Incluindo a conexão com o BD
require_once '../connect/connectionBd.php';

#Função que cria usuário dentro do BD
function createUser($userInformation) {
  #Chama a funçãod e conexão com o BD

  #Laço de repetição
  foreach($userInformation as $keyIndex => $userContent){
    #Verifica se os campos de existem
    if($keyIndex == 'name' || $keyIndex == 'email' || $keyIndex == 'password'){
      #Cria variáveis com cada informação
      $name = $userInformation['name'];
      $email = $userInformation['email'];
      $password = $userInformation['password'];
    }
  }
    #A senha criada, é transformada em um hash único
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    #Comando SQL de insert no BD
    $queryInsert = 'INSERT INTO CADASTRO_USUARIOS (NOME, EMAIL, SENHA) VALUES (?, ?, ?)';

    $values = [$name, $email, $hashedPassword];

    $resultOfInsert = dbQueryInsert($queryInsert, $values);

    #Verifica se o insert foi realizado
    if ($resultOfInsert) {
      #Pegando o Id inserido do usuário
      $_SESSION["userId"] = $resultOfInsert;

      $success = "Bem-vindo(a)";
      return ['valid' => $success];

    } else {
      #Se naõ, retorna false
      return false;
    }
}

?>