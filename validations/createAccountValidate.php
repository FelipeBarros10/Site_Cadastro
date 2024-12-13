<?php 

//Incluindo a conexão com o BD
require_once '../connect/connectionBd.php';

function registerValidate($userInformation){

  #Tirando possíveis espaços em branco
  foreach($userInformation as $key => $value){
    $userInformation[$key] = trim($userInformation[$key]);
  }

  #Validação de nomes
  if(empty($userInformation['name'])){
    $errors['nameEmpty'] = "O nome não pode ser vazio";
  } else if(strlen($userInformation['name']) < 2) {
    $errors['nameShortLength'] = "O nome deve ter no mínimo 2 caracteres.";
  } 

  if (strlen($userInformation['name']) > 50) {
    $errors['nameLongLength'] = "O nome deve ter no máximo 50 caracteres.";
  }


  #Validação de email
  if(!filter_var($userInformation['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Insira um endereço de e-mail válido. Exemplo: \"exemplo@dominio.com\".";
  } else {
    $conn = connectDb();
    $result = dbQuery($conn, 'SELECT * FROM CADASTRO_USUARIOS');

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['EMAIL'] == $userInformation['email']) {
          $errors['emailExist'] = "Este e-mail já está cadastrado. Faça login para continuar.";
        }
      }
    }
  }

  #Validação de senhas
  if(strlen($userInformation['password']) < 6){
    $errors['passwordLength'] = "A senha deve conter pelo menos 6 caracteres.";
  } else if(!preg_match('/[A-Z]/',$userInformation['password'])){
    $errors['passwordUpperCase'] = "A senha deve conter pelo menos uma letra maiúscula.";
  }

  if(isset($errors)){
    return ['invalid' => $errors];
  }
  
  return $userInformation;
}


?>