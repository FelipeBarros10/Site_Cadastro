<?php require_once __DIR__ . "/../config/config.php" ?>
<?php require_once __DIR__ . "/../connect/connectionBd.php" ?>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../Assets/css/registerAndShowProductsPages.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
        <form action="../controller/handleRegisterProducts.php" method="post" enctype="multipart/form-data">
          <div class="register-inputs">

            <div class="first-content-inputs">

              <div class="input-name-product">
                <label>Nome do produto</label>
                <input type="text" name="productName" id="">
              </div>

              <div class="button-img-product">

                <div class="currentImg">
                  <img src="../Assets/img/iconeUser.jpg" alt="" />
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
                  <input type="text" name="price" id="price">
                </div>

                <div class="input-cost">
                  <label>Custo</label>
                  <input type="text" name="cost" id="cost">
                </div>

                <div class="input-stock">
                  <label>Quantidade</label>
                  <input type="text" name="quantity" id="">
                </div>

                <div class="button-register">
                  <button>Cadastrar</button>
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

              </div>
            </div>
          </div><!--até aqui-->
        </form>
      </div>

    </main>
  </div>




</body>