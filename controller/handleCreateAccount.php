<?php
#startando a sessão

session_start();

#Incluindo os arquivos necessários
require_once __DIR__ .  '/../model/usuarios.php';
require_once __DIR__ .  '/../validations/createAccountValidate.php';

#Valida se a requisição POST aconteceu 
if (isset($_POST)) {
  #Se sim, uma variável é criada para receber as informações do usuário  
  $userInformation = $_POST;
  #Passa as informações para a função que cuidará do login
  register($userInformation);
  
}

function register($userInformation, $profileImage = "") {
  #Criando uma variável que recebe o retorno das validações feitas das informações do usuário
  $userInformationValidating = registerValidate($userInformation, $profileImage);
  
  #Verifica se há algo inválido nas validações que foram feitas
  if(isset($userInformationValidating['invalid'])){
    #Se sim, é criada uma variável de sessão que recebe esses erros
     $_SESSION['errors'] = $userInformationValidating['invalid'];
    #Retorna para a página inicial de login
     header('Location: ../index.php');
     exit();
  } else {

    if(isset($_FILES)){
      $profileImage = $_FILES["profileImage"];
    } 
    #Se não, criamos uma variável que recebe a criação do usuário no BD
    $userCreated = createUser($userInformation,$profileImage);
    #Verifica se foi criado
    if(isset($userCreated["valid"])){
      #Se sim, passa para a próxima página
      header('Location: ../views/mainPage.php');
    } 
  }
  return;
}
