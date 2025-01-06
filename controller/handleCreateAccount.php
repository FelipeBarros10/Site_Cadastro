<?php
#startando a sessão

session_start();

#Incluindo os arquivos necessários
include_once '../model/usuarios.php';
include_once '../validations/createAccountValidate.php';

#Valida se a requisição POST aconteceu 
if (isset($_POST)) {
  #Se sim, uma variável é criada para receber as informações do usuário  
  $userInformation = $_POST;
  #Passa as informações para a função que cuidará do login
  register($userInformation);

}

function register($userInformation) {
  #Criando uma variável que recebe o retorno das validações feitas das informações do usuário
  $userInformationValidating = registerValidate($userInformation);

  #Verifica se há algo inválido nas validações que foram feitas
  if(isset($userInformationValidating['invalid'])){
    #Se sim, é criada uma variável de sessão que recebe esses erros
     $_SESSION['errors'] = $userInformationValidating['invalid'];
    #Retorna para a página inicial de login
     header('Location: ../index.php');
     exit();
  } else {
    #Se não, criamos uma variável que recebe a criação do usuário no BD
    $userCreated = createUser($userInformation);
    
    #Verifica se foi criado
    if(isset($userCreated)){
      #Se sim, passa para a próxima página
      header('Location: ../views/mainPage.php');
    } 
  }
  return;
}
