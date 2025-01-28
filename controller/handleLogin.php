<?php
#startando a sessão
session_start();

#Incluindo os arquivos necessários
include_once '../model/usuarios.php';
include_once '../validations/loginValidate.php';


#Valida se a requisição POST aconteceu 
if(isset($_POST)){
  #Se sim, uma variável é criada para receber as informações do usuário
  $userInformation = $_POST;

  #Passa as informações para a função que cuidará do login
  login($userInformation);
  
}

function login($userInformation) {

  #Criando uma variável que recebe o retorno das validações feitas das informações do usuário
  $userLoginValidating = loginValidate($userInformation);

  #Verifica se há algo inválido nas validações que foram feitas
  if(isset($userLoginValidating['invalid'])){
    #Se sim, é criada uma variável de sessão que recebe esses erros
     $_SESSION['errorsLogin'] = $userLoginValidating['invalid'];
    #Retorna para a página inicial de login
     header('Location: ../index.php');
     exit();
  } else {
    #Se não, verifica se possui a mensagem de que as informações estão validadas
    if(isset($userLoginValidating['valid'])){
      #Se sim, passa para a próxima página
      header('Location: ../views/mainPage.php');
      exit();
    } 
  }
  return;
}


?>
