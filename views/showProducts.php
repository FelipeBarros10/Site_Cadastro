<?php require_once __DIR__ . "/../config/config.php" ?>
<?php require_once __DIR__ . "/../connect/connectionBd.php" ?>

<?php $pageCss = "/../Assets/css/registerAndShowProductsPages.css" ?>

<?php require_once __DIR__ . "/../components/head.php"?>

<body class="showProductsPage">
  <div class="main-parent">
    <?php include '../components/sideBar.php' ?>

    <?php
    $page_title = "Seu Produto";
    include '../components/headerTop.php'
    ?>

    <main data-aos="zoom-in" class="main-register-content">

      <div class="loading" id="loading">
        <dotlottie-player src="https://lottie.host/33022999-343c-4490-b368-1fd709b0081b/2ax7KO5izZ.lottie" background="transparent" speed="3" style="width: 50%; height: 50%" direction="1" playMode="forward" loop autoplay></dotlottie-player>
      </div>
      <div class="main-register-products">
        <form id="form" action="../controller/handleShowAndEditProducts.php" method="post" enctype="multipart/form-data">
          <div class="register-inputs">
            <div class="first-content-inputs">

              <?php
              $idProduct = $_GET["id"];
              $_SESSION["productId"] = $idProduct;

              if (isset($idProduct)) {
                $_SESSION["currentProductId"] = $idProduct;
                $query = "SELECT * FROM produtos WHERE ID = ?";
                $values = $idProduct;

                $result = dbQuery($query, $values);

                if (mysqli_num_rows($result) > 0) {
                  $rowProduct = mysqli_fetch_assoc($result);
                }
              }


              ?>

              <div class="input-name-product">
                <label>Nome do produto</label>
                <input type="text" name="productName" id="" value="<?php echo $rowProduct["NOME"] ?>">
              </div>

              <?php
              if (isset($_SESSION['errorsShowAndEditProducts'])) {
                echo "<div id='error-messages-login' class='error-messages'>";
                foreach ($_SESSION['errorsShowAndEditProducts'] as $errorIndex => $errorMessage) {
                  if ($errorIndex === 'productNameEmpty') {
                    echo "<script>
                                    alertify.error('$errorMessage');
                                  </script>";
                  }
                }
                echo "</div>";
              }
              ?>

              <div class="button-img-product">

                <div class="currentImg">
                  <img src="../Assets/img/<?php echo $rowProduct["IMAGENS"] ?>" alt="" id="currentImgProduct" />
                </div>

                <?php
                if (isset($_SESSION['errorsShowAndEditProducts'])) {
                  echo "<div id='error-messages-login' class='error-messages'>";
                  foreach ($_SESSION['errorsShowAndEditProducts'] as $errorIndex => $errorMessage) {
                    if ($errorIndex === 'invalidImage') {
                      echo "<script>
                                    alertify.error('$errorMessage');
                                  </script>";
                    }
                  }
                  echo "</div>";
                }
                ?>

                <input type="file" name="file" id="inputFile" style="display: none;">
                <button class="btnChangeImg" type="button" id="btn" onclick="openFile()">
                  <span>Alterar imagem</span>
                </button>


              </div>
            </div>

            <div class="second-content-input">
              <div class="input-price-stock-product">
                <div class="input-price">
                  <label>Preço</label>
                  <input type="text" name="price" id="inputPrice" value="<?php echo $rowProduct["PRECO"] ?>">
                </div>

                <?php
                if (isset($_SESSION['errorsShowAndEditProducts'])) {
                  echo "<div id='error-messages-login' class='error-messages'>";
                  foreach ($_SESSION['errorsShowAndEditProducts'] as $errorIndex => $errorMessage) {
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
                  <input type="text" name="cost" id="inputCost" value="<?php echo $rowProduct["CUSTO"] ?>">
                </div>

                <?php
                if (isset($_SESSION['errorsShowAndEditProducts'])) {
                  echo "<div id='error-messages-login' class='error-messages'>";
                  foreach ($_SESSION['errorsShowAndEditProducts'] as $errorIndex => $errorMessage) {
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

                <div class="button-register">
                  <button type="button" onclick="loadingContent()">Atualizar</button>
                </div>

              </div>

              <div class="input-category-product">
                <div class="select-category">
                  <label>Categoria cadastrada</label>
                  <?php
                  $query = "SELECT id, nome  FROM categorias";
                  $queryResult = dbQuery($query);

                  echo "<select name='selectCategory' id=''>";

                  if (mysqli_num_rows($queryResult) > 0) {
                    while ($row = mysqli_fetch_assoc($queryResult)) {
                      if ($row["id"] === $idProduct) {
                        echo "<option value='{$row["nome"]}' selected>{$row["nome"]}</option>";
                      }
                      echo "<option value='{$row["nome"]}'>{$row["nome"]}</option>";
                    }
                  }
                  echo '</select>';


                  if (isset($_SESSION['errorsShowAndEditProducts'])) {
                    echo "<div id='error-messages-login' class='error-messages'>";
                    foreach ($_SESSION['errorsShowAndEditProducts'] as $errorIndex => $errorMessage) {
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

                      if ($errorIndex === 'bothFilled') {
                        echo "<script>
                                  alertify.error('$errorMessage');
                                </script>";
                      }
                    }
                    echo "</div>";
                  }
                  ?>

                </div>

                <div class="input-stock">
                  <label>Quantidade</label>
                  <input type="text" name="quantity" id="" value="<?php echo $rowProduct["QUANTIDADE_ESTOQUE"] ?>">
                </div>

                <?php
                if (isset($_SESSION['errorsShowAndEditProducts'])) {
                  echo "<div id='error-messages-login' class='error-messages'>";
                  foreach ($_SESSION['errorsShowAndEditProducts'] as $errorIndex => $errorMessage) {
                    if ($errorIndex === 'quantityEmpty') {
                      echo "<script>
                                    alertify.error('$errorMessage');
                                  </script>";
                    }
                  }
                  echo "</div>";
                }
                unset($_SESSION['errorsShowAndEditProducts']);
                ?>

                <div class="who-registered-product">
                  <label>Responsável pelo cadastro:</label>
                  <div>
                    <?php
                    $query = "SELECT * FROM cadastro_usuarios WHERE ID = ?";
                    $value = $rowProduct["ID_USUARIO"];

                    $result = dbQuery($query, $value);

                    if (mysqli_num_rows($result) > 0) {
                      $rowUsers = mysqli_fetch_assoc($result);
                    }

                    echo "<i class='bi bi-person-fill'></i>";
                    echo "<span>{$rowUsers["NOME"]}</span>";
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div><!--até aqui-->
        </form>
      </div>
    </main>
  </div>
  <script src="../Assets/js/stylingInputPrice.js"></script>
  <script src="../Assets/js/loadingPageAnimation.js"></script>

  <script>AOS.init()</script>
</body>
