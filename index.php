<?php
session_start();
?>

<?php $pageCss = "/Assets/css/login.css" ?>

<?php require_once __DIR__ . "/components/head.php"?>

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
          <h2 class="title title-second">faça login no register</h2>
          <div class="social-media">
            <!-- <ul class="list-social-media">
              <a class="link-social-media icon-modify" href="#">
                <li class="item-social-media">
                  <i class="bi bi-google"></i>
                </li>
              </a>
            </ul> -->
          </div><!-- social media -->
          <!-- <p class="description description-second">ou use sua conta de email:</p> -->
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
            <!-- <a class="password" href="#">Esqueceu sua senha?</a> -->
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
          <h2 class="title title-second">crie sua conta</h2>
          <div class="social-media">
            <!-- <ul class="list-social-media">
              <a class="link-social-media" href="#">
                <li class="item-social-media icon-modify">
                  <i class="bi bi-google "></i>
                </li>
              </a>
            </ul> -->
          </div><!-- social media -->
          <!-- <p class="description description-second">ou use seu email para o cadastro:</p> -->
          <form action="controller/handleCreateAccount.php" method="post" class="form" enctype="multipart/form-data">

            <div class="profileImg">
              <div>
                <input style="display: none;" type="file" name="profileImage" id="inputFile" accept="image/*">
                <button type="button" id="btn" onclick="openFile()">
                  <img src="./Assets/img/iconeUser.png" id="profileImg" />
                </button>
              </div>

              <div>
                <span>Insira sua foto de perfil</span>
              </div>
            </div>

            <label class="label-input" for="">
              <i class="bi bi-person icon-modify"></i>
              <input type="text" name="name" placeholder="Nome">
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
            <button class="btn btn-second">cadastre-se</button>
          </form>
        </div><!-- second column -->
      </div><!-- second-content -->
    </div>
  </div>

  <script  src="./Assets/js/global.js"></script>
  <script  src="./Assets/js/login.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>