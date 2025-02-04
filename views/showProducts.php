'<?php require_once __DIR__ . "/../config/config.php" ?>
<?php require_once __DIR__ . "/../connect/connectionBd.php" ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../Assets/css/registerAndShowProductsPages.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/cleave.js"></script>
</head>

<body class="showProductsPage">
  <div class="main-parent">
    <?php include '../components/sideBar.php' ?>

    <?php
    $page_title = "Seu Produto";
    include '../components/headerTop.php'
    ?>

    <main class="main-register-content">
      <div class="main-register-products">
        <form action="../controller/handleShowAndEditProducts.php" method="post" enctype="multipart/form-data">
          <div class="register-inputs">

            <div class="first-content-inputs">

              <?php 
                $idProduct = $_GET["id"];

                if(isset($idProduct)){
                  $_SESSION["currentProductId"] = $idProduct;
                  $query = "SELECT * FROM produtos WHERE ID = ?";
                  $values = $idProduct;

                  $result = dbQuery($query, $values);

                  if(mysqli_num_rows($result) > 0){
                    $rowProduct = mysqli_fetch_assoc($result);
                  }
                }
              
              
              ?>

              <div class="input-name-product">
                <label>Nome do produto</label>
                <input type="text" name="productName" id="" value="<?php echo $rowProduct["NOME"] ?>">
              </div>

              <div class="button-img-product">

                <div class="currentImg">
                  <img src="../Assets/img/<?php echo $rowProduct["IMAGENS"] ?>" alt="" />
                </div>

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
                  <input type="text" name="price" id="price" value="<?php echo $rowProduct["PRECO"] ?>">
                </div>

                <div class="input-cost">
                  <label>Custo</label>
                  <input type="text" name="cost" id="cost" value="<?php echo $rowProduct["CUSTO"] ?>">
                </div>

                <div class="input-stock">
                  <label>Quantidade</label>
                  <input type="text" name="quantity" id="" value="<?php echo $rowProduct["QUANTIDADE_ESTOQUE"] ?>">
                </div>

                <div class="button-register">
                  <button>Atualizar</button>
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
                        if($row["id"] === $idProduct){
                          echo "<option value='{$row["nome"]}' selected>{$row["nome"]}</option>";
                        }
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

                <div class="who-registered-product">
                  <label>Responsável pelo cadastro:</label>
                  <div>
                    <?php 
                      $query = "SELECT * FROM cadastro_usuarios WHERE ID = ?";
                      $value = $rowProduct["ID_USUARIO"];

                      $result = dbQuery($query, $value);

                      if(mysqli_num_rows($result) > 0){
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
<<<<<<< HEAD
</body>

<script src="../Assets/js/global.js"></script>
</body>'

=======
<script src="../Assets/js/global.js"></script>
</body>
>>>>>>> c1bdc4e10bdcb492fcb1eecc374982d6ce88eb21
