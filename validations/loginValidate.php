<?php

#Incluindo a conexão com o BD
require_once __DIR__ . '/../connect/connectionBd.php';
require_once __DIR__ . '/../config/cookie.php';

#Função para validar login
function loginValidate($userInformation){
  #Laço de repetição que vai passar por todos os índices do array que contém as informações do usuário

  foreach($userInformation as $keyIndex => $keyMessage){
    #Retirando os espaços em branco de cada índice

    $userInformation[$keyIndex] = trim($userInformation[$keyIndex]);
  }

  #Verificação se a informação de email está vazia
  if(empty($userInformation['email'])) {
    #Se sim, uma variável de erros é criada e nela e passada um valor associativo contendo o aviso de erro

    $errors['emailEmpty'] = "O e-mail não pode ser vazio";
    # Se não estiver vazio, faz uma verificação do formato do e-mail

  } elseif (!filter_var($userInformation['email'], FILTER_VALIDATE_EMAIL)) {
    #Se o formato estiver errado insere um erro dentro do array de erros

    $errors['emailEstructure'] = "Insira um endereço de e-mail válido. Exemplo: \"exemplo@dominio.com\".";
  }

  #Verifica se a senha não está vazia
  if(empty($userInformation['password'])) {
    #Se sim, insere um erro dentro do array de erros
    $errors['password'] = "A senha não pode ser vazia";

  } else {
    #Se não estiver vazia, uma função é chamada para validar as informações do usuário no BD

    $checkingAtDB = loginValidateAtDB($userInformation);


    #Verifica se o retorno da função de validação dentro do BD
    if($checkingAtDB == true){
      #Se for verdade, ou seja se existir no BD, retorna uma mensagem de sucesso
      $success = "Bem-vindo(a) de volta";
      # retorna a variável de sucesso dentro de um array que tem um associativo
      return ['valid' => $success];
    } else {
      #Se não existir as informações no BD insere um erro dentro da variável de erros
      $errors['doesntExistAtDB'] = "E-mail ou senha não encontrados. Tente novamente.";
    }
  }

  #Depois de todas as validações, verifica se em algum momento a variável de erros existiu
  if(isset($errors)){
    #Se sim, retorna a variável com os erros dentro de um array que contém um valor associativo 
    return ['invalid' => $errors];
  } else{
    return $userInformation;
  }
}


#Função que irá validar as informações do usuário dentro do BD
function loginValidateAtDB ($userInformation){
  #Chama a função que faz a conexão com o banco de dados
  $conn = connectDb();
  #Comando que será usado no BD
  $query = "SELECT ID,SENHA FROM CADASTRO_USUARIOS WHERE EMAIL = ?";
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

