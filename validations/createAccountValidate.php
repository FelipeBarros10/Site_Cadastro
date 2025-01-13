<?php 

#Incluindo a conexão com o BD
require_once '../connect/connectionBd.php';

#Função que vai validar o registro do usuário
function registerValidate($userInformation){

  #Laço de repetição que vai passar por todos os índices do array que contém as informações do usuário
  foreach($userInformation as $key => $value){
    #Retirando os espaços em branco de cada índice, caso tenha
    $userInformation[$key] = trim($userInformation[$key]);
  }

  #Validação de nomes, verifica se o campo está vazio
  if(empty($userInformation['name'])){

    #Se sim, uma variável de erros é criada e nela e passada um valor associativo contendo o aviso de erro
    $errors['nameEmpty'] = "O nome não pode ser vazio";
  } else if(strlen($userInformation['name']) < 2) {

    #Se for menor que 2, uma variável de erros é criada e nela e passada um valor associativo contendo o aviso de erro
    $errors['nameShortLength'] = "O nome deve ter no mínimo 2 caracteres.";
  } 

  #Verifica se o cumprimento do nom é maior que 50 caracteres
  if (strlen($userInformation['name']) > 50) {
     #Se sim, uma variável de erros é criada e nela e passada um valor associativo contendo o aviso de erro
    $errors['nameLongLength'] = "O nome deve ter no máximo 50 caracteres.";
  }


  #Validação de email
  if(!filter_var($userInformation['email'], FILTER_VALIDATE_EMAIL)){
    #Se o formato estiver errado insere um erro dentro do array de erros
    $errors['email'] = "Insira um endereço de e-mail válido. Exemplo: \"exemplo@dominio.com\".";
  } else {
    #Se não, a função de conexão do BD é chamada
    $conn = connectDb();
    #A consulta é realizada, chamando uma função que recebe
    $result = dbQuerySelect($conn, 'SELECT * FROM CADASTRO_USUARIOS');

    #Verifica se o número de linhas é maior que 0
    if (mysqli_num_rows($result) > 0) {
      #Enquanto tiver linhas no BD o laço de repetição acontece
      while ($row = mysqli_fetch_assoc($result)) {
        #Verifica se o email que está na linha é o mesmo que o usuário inclui no campo
        if ($row['EMAIL'] == $userInformation['email']) {
          #Se sim, insere um erro dentro do array de erros
          $errors['emailExist'] = "Este e-mail já está cadastrado. Faça login para continuar.";
        }
      }
    }
  }

  #Verifica se o cumprimento do nom é menor que 6 caracteres
  if(strlen($userInformation['password']) < 6){

    #Se sim, insere um erro dentro do array de erros
    $errors['passwordLength'] = "A senha deve conter pelo menos 6 caracteres.";

  } else if(!preg_match('/[A-Z]/',$userInformation['password'])){

    #Se não houver letra maiúscula na senha, insere um erro dentro do array de erros
    $errors['passwordUpperCase'] = "A senha deve conter pelo menos uma letra maiúscula.";

  }

  #Depois de todas as validações, verifica se em algum momento a variável de erros existiu
  if(isset($errors)){
    #Se sim, retorna a variável com os erros dentro de um array que contém um valor associativo 
    return ['invalid' => $errors];
  }
  #Se não houver erros, apenas retorna as informações do usuário
  return $userInformation;
}


?>