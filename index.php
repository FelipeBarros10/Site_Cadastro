<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" href="./Assets/css/login.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
  <div class="main">
    <div data-aos="zoom-in-up" class="container">
      <div class="content first-content">
        <div class="first-column">
          <h2 class="title title-primary">olá, amigo!</h2>
          <p class="description description-primary">Insira seus dados pessoais</p>
          <p class="description description-primary">
          e comece a jornada conosco</p>
          <button id="signup" class="btn btn-primary">cadastre-se</button>
        </div>
        <div class="second-column">
          <h2 class="title title-second">faça login com google</h2>
          <div class="social-media">
            <ul class="list-social-media">
              <a class="link-social-media icon-modify" href="#">
                <li class="item-social-media">
                  <i class="bi bi-google"></i>
                </li>
              </a>
            </ul>
          </div><!-- social media -->
          <p class="description description-second">ou use sua conta de email:</p>
          <form action="controller/handleLogin.php" method="post" class="form">

            <label class="label-input" for="">
              <i class="far fa-envelope icon-modify"></i>
              <input type="email" name="email" placeholder="Email">
            </label>
            <?php
            if (isset($_SESSION['errorsLogin'])) {
              echo "<div id='error-messages-login' class='error-messages'>";

              foreach ($_SESSION['errorsLogin'] as $errorIndex => $errorMessage) {
                if ($errorIndex === 'emailEmpty') {
                  echo "<p>{$errorMessage}</p>";
                }

                if ($errorIndex === 'emailEstructure') {
                  echo "<p>{$errorMessage}</p>";
                }
              }
              echo "</div>";
            }

            ?>

            <label class="label-input" for="">
              <i class="fas fa-lock icon-modify"></i>
              <input id="passwordInput" type="password" name="password" placeholder="Senha">
            </label>
            <?php
            if (isset($_SESSION['errorsLogin'])) {
              echo "<div id='error-messages-login' class='error-messages'>";

              foreach ($_SESSION['errorsLogin'] as $errorIndex => $errorMessage) {
                if ($errorIndex === 'password') {
                  echo "<p>{$errorMessage}</p>";
                }

                if($errorIndex === 'doesntExistAtDB'){
                  echo "<p>{$errorMessage}</p>";
                }
              }
              echo "</div>";
            }

            ?>
            <a class="password" href="#">Esqueceu sua senha?</a>
            <button class="btn btn-second">entrar</button>
          </form>
        </div><!-- second column -->
      </div><!-- first content -->


      <div id="secondContent" class="content second-content">
        <div class="first-column">
          <h2 class="title title-primary">Bem vindo de volta!</h2>
          <p class="description description-primary">
          Para se manter conectado conosco</p>
          <p class="description description-primary">por favor faça login com suas informações pessoais</p>
          <button id="signin" class="btn btn-primary">login</button>
        </div>
        <div class="second-column">
          <h2 class="title title-second">create account</h2>
          <div class="social-media">
            <ul class="list-social-media">
              <a class="link-social-media" href="#">
                <li class="item-social-media icon-modify">
                  <i class="bi bi-google "></i>
                </li>
              </a>
            </ul>
          </div><!-- social media -->
          <p class="description description-second">or use your email for registration:</p>
          <form action="controller/handleCreateAccount.php" method="post" class="form">
            <label class="label-input" for="">
              <i class="bi bi-person icon-modify "></i>
              <input type="text" name="name" placeholder="Name">
            </label>
            <?php
            if (isset($_SESSION['errors'])) {
              echo "<div class='error-messages'>";

              foreach ($_SESSION['errors'] as $errorIndex => $errorMessage) {
                if ($errorIndex === 'nameEmpty') {
                  echo "<p>{$errorMessage}</p>";
                }

                if ($errorIndex === 'nameShortLength') {
                  echo "<p>{$errorMessage}</p>";
                }

                if ($errorIndex === 'nameLongLength') {
                  echo "<p>{$errorMessage}</p>";
                }
              }
              echo "</div>";
            }

            ?>

            <label class="label-input" for="">
              <i class="bi bi-envelope icon-modify "></i>
              <input type="text" name="email" placeholder="Email">
            </label>

            <?php
            if (isset($_SESSION['errors'])) {
              echo "<div id='error-messages' class='error-messages'>";

              foreach ($_SESSION['errors'] as $errorIndex => $errorMessage) {
                if ($errorIndex === 'email') {
                  echo "<p>{$errorMessage}</p>";
                }

                if ($errorIndex === 'emailExist') {
                  echo "<p>{$errorMessage}</p>";
                }
              }
              echo "</div>";
            }

            ?>

            <label class="label-input" for="">
              <i class="bi bi-lock-fill icon-modify "></i>
              <input type="password" name="password" placeholder="Password">
            </label>

            <?php
            if (isset($_SESSION['errors'])) {
              echo "<div class='error-messages'>";

              foreach ($_SESSION['errors'] as $errorIndex => $errorMessage) {
                if ($errorIndex === 'passwordLength') {
                  echo "<p>{$errorMessage}</p>";
                }

                if ($errorIndex === 'passwordUpperCase') {
                  echo "<p>{$errorMessage}</p>";
                }
              }
              echo "</div>";
              unset($_SESSION['errors']);
            }

            ?>
            <button class="btn btn-second">sign up</button>
          </form>
        </div><!-- second column -->
      </div><!-- second-content -->
    </div>
  </div>

  <script src="./Assets/js/login.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>