<?php require_once __DIR__ . "/../config/config.php" ?>
<?php require_once __DIR__  . '/../model/products.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="shortcut icon" type="image/png" href="/Assets/img/logo2.png">
  <link rel="stylesheet" href="../Assets/css/registerAndShowProductsPages.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="../vendor/alertifyjs/css/alertify.min.css" />
  <link rel="stylesheet" href="../vendor/alertifyjs/css/themes/default.min.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="../vendor/alertifyjs/alertify.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/cleave.js"></script>
  <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
</head>

<body>
  <div class="main-parent">
    <?php require_once __DIR__  . '/../components/sideBar.php' ?>

    <?php
    $page_title = "Cadastre seu produto";
    require_once __DIR__  . '/../components/headerTop.php'
    ?>

    <main data-aos="zoom-in" class="main-register-content">
      <div class="loading" id="loading">
        <dotlottie-player src="https://lottie.host/33022999-343c-4490-b368-1fd709b0081b/2ax7KO5izZ.lottie" background="transparent" speed="3" style="width: 50%; height: 50%" direction="1" playMode="forward" loop autoplay></dotlottie-player>
      </div>

      <div class="main-register-products">
        <form id="form" action="../controller/handleRegisterProducts.php" method="post" enctype="multipart/form-data">
          <div class="register-inputs">

            <div class="first-content-inputs">

              <div class="input-name-product">
                <label>Nome do produto</label>
                <input type="text" name="productName" id="">
              </div>
              <?php
              if (isset($_SESSION['errorsRegisterProduct'])) {
                foreach ($_SESSION['errorsRegisterProduct'] as $errorIndex => $errorMessage) {
                  if ($errorIndex === 'productNameEmpty') {
                    echo "<script>
                                alertify.error('$errorMessage');
                              </script>";
                  }
                }
              }
              ?>

              <div class="button-img-product">
                <input type="file" name="file" id="inputFile" style="display: none;">

                <button type="button" id="btn" onclick="openFile()">
                  <i id="iconBtn" class="bi bi-camera-fill"></i>
                </button>

                <span>Imagem do produto</span>
              </div>
            </div>

            <div class="second-content-input">
              <div class="input-price-stock-product">
                <div class="input-price">
                  <label>Preço</label>
                  <input type="text" name="price" id="inputPrice">
                </div>

                <?php
                if (isset($_SESSION['errorsRegisterProduct'])) {
                  echo "<div id='error-messages-login' class='error-messages'>";
                  foreach ($_SESSION['errorsRegisterProduct'] as $errorIndex => $errorMessage) {
                    if ($errorIndex === 'priceEmpty') {
                      echo "<script>
                                  alertify.error('$errorMessage');
                                </script>";
                    }

                    if ($errorIndex === 'priceEqualZero') {
                      echo "<script>
                                alertify.error('$errorMessage');
                              </script>";
                    }
                  }
                  echo "</div>";
                }

                ?>

                <div class="input-cost">
                  <label>Custo</label>
                  <input type="text" name="cost" id="inputCost">
                </div>
                <?php
                if (isset($_SESSION['errorsRegisterProduct'])) {
                  echo "<div id='error-messages-login' class='error-messages'>";
                  foreach ($_SESSION['errorsRegisterProduct'] as $errorIndex => $errorMessage) {
                    if ($errorIndex === 'emptyCost') {
                      echo "<script>
                                    alertify.error('$errorMessage');
                                  </script>";
                    }

                    if ($errorIndex === 'costEqualZero') {
                      echo "<script>
                                  alertify.error('$errorMessage');
                                </script>";
                    }
                  }
                  echo "</div>";
                }


                ?>

                <div class="input-stock">
                  <label>Quantidade</label>
                  <input type="text" name="quantity" id="">
                </div>

                <?php
                if (isset($_SESSION['errorsRegisterProduct'])) {
                  echo "<div id='error-messages-login' class='error-messages'>";
                  foreach ($_SESSION['errorsRegisterProduct'] as $errorIndex => $errorMessage) {
                    if ($errorIndex === 'quantityEmpty') {
                      echo "<script>
                                    alertify.error('$errorMessage');
                                  </script>";
                    }

                    if ($errorIndex === 'quantityEqualZero') {
                      echo "<script>
                                  alertify.error('$errorMessage');
                                </script>";
                    }
                  }
                  echo "</div>";
                }


                ?>

                <div class="button-register">
                  <button type="button" onclick="loadingContent()" id="registerBtn">Cadastrar</button>
                </div>
              </div>

              <div class="input-category-product">
                <div class="select-category">
                  <label>Selecione a categoria</label>
                  <?php
                  $query = "SELECT nome FROM categorias";
                  $queryResult = dbQuery($query);

                  echo "<select name='selectCategory' id=''>";
                  echo "<option value=''>Selecione uma categoria</option>";
                  if (mysqli_num_rows($queryResult) > 0) {
                    while ($row = mysqli_fetch_assoc($queryResult)) {
                      echo "<option value='{$row["nome"]}'>{$row["nome"]}</option>";
                    }
                  }
                  echo '</select>';
                  ?>

                </div>

                <div class="input-new-category">
                  <label>Nova categoria</label>
                  <input type="text" name="newCategory" id="">
                </div>

                <?php
                if (isset($_SESSION['errorsRegisterProduct'])) {
                  echo "<div id='error-messages-login' class='error-messages'>";
                  foreach ($_SESSION['errorsRegisterProduct'] as $errorIndex => $errorMessage) {
                    if ($errorIndex === 'selectCategory') {
                      echo "<script>
                                    alertify.error('$errorMessage');
                                  </script>";
                    }

                    if ($errorIndex === 'categorieAlreadyExist') {
                      echo "<script>
                                  alertify.error('$errorMessage');
                                </script>";
                    }
                  }
                  echo "</div>";
                }

                unset($_SESSION['errorsRegisterProduct']);
                ?>
              </div>
            </div>
          </div><!--até aqui-->
        </form>
      </div>
    </main>
  </div>

  <script src="../Assets/js/global.js"></script>
  <script src="../Assets/js/stylingInputPrice.js"></script>
  <script src="../Assets/js/loadingPageAnimation.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>