<?php

#Incluindo a conexão com o BD
require_once __DIR__ . '/../connect/connectionBd.php';
require_once __DIR__ . "/../services/imageHashedService.php";
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

#Função que irá validar as informações do usuário dentro do BD
function loginValidateAtDB ($userInformation){
  #Chama a função que faz a conexão com o banco de dados
  $conn = connectDb();
  #Comando que será usado no BD
  $query = "SELECT ID,SENHA FROM cadastro_usuarios WHERE EMAIL = ?";
  #Cria uma variável que prepara a conexão com o comando sql
  $stmt = $conn->prepare($query);
  #Binda o parâmetro "?" da consulta com o email do usuário para a consulta sql acontecer
  $stmt->bind_param("s", $userInformation['email']);

  #Verificação que vai chamar a execução da consulta
  if($stmt->execute()){
    #Se a consulta acontecer, armazena o resultado dentro de uma variável
    $results = $stmt->get_result();
  };

  #Verifica se a quantidade de linhas da consulta é igual a 0
  if(mysqli_num_rows($results) == 0){
    #Se sim, encerra a função retornando falso
    return false;
  } elseif (mysqli_num_rows($results) > 0){
    #Se não for, passa a linha do resultado do login encontrado para uma variável
    $row = mysqli_fetch_assoc($results);
    #Pega a senha do usuário e coloca em uma variável
    $hashedPassword = $row['SENHA'];


    #Validação se a senha passada pelo usuário é a mesma que está no BD
    if(password_verify($userInformation['password'], $hashedPassword)){

      $userCookie = setUserCookie("user", "{$row['ID']}");
      if(isset($userCookie)){
        $_SESSION["userId"] = $row['ID'];
        #Se for o mesmo, retorna true
        return true;
      } else{
        return false;
      } 
    } else {
      #Se não, retorna falso
      return false;
    }
  }
}

