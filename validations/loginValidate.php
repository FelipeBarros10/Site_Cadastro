<?php 
//Incluindo a conexão com o BD
require_once '../connect/connectionBd.php';


function loginValidate($userInformation){
  foreach($userInformation as $keyIndex => $keyMessage){
    $userInformation[$keyIndex] = trim($userInformation[$keyIndex]);
  }

  if(empty($userInformation['email'])) {
    $errors['emailEmpty'] = "O e-mail não pode ser vazio";
  } elseif (!filter_var($userInformation['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['emailEstructure'] = "Insira um endereço de e-mail válido. Exemplo: \"exemplo@dominio.com\".";
  }

  if(empty($userInformation['password'])) {
    $errors['password'] = "A senha não pode ser vazia";

  } else {
    $checkingAtDB = loginValidateAtDB($userInformation);

    if($checkingAtDB == true){
      $success = "Bem-vindo(a) de volta";
      return ['valid' => $success];
    } else {
      $errors['doesntExistAtDB'] = "E-mail ou senha não encontrados. Tente novamente.";
    }
  }

  if(isset($errors)){
    return ['invalid' => $errors];
  } 
}


function loginValidateAtDB ($userInformation){
  $conn = connectDb();
  $query = "SELECT SENHA FROM CADASTRO_USUARIOS WHERE EMAIL = ?";
  $stmt= $conn->prepare($query);
  $stmt->bind_param("s", $userInformation['email']);

  if($stmt->execute()){
    $results = $stmt->get_result();
  };

  if(mysqli_num_rows($results) == 0){
    return false;
  } elseif (mysqli_num_rows($results) > 0){
    $row = mysqli_fetch_assoc($results);
    $hashedPassword = $row['SENHA'];

    if(password_verify($userInformation['password'], $hashedPassword)){
      return true;
    } else {
      return false;
    }
  }
}





?>