<?php require_once __DIR__ . "/../config/config.php" ?>
<?php require_once __DIR__  . '/../model/products.php'?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../Assets/css/registerAndShowProductsPages.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/cleave.js"></script>
</head>

<body>
  <div class="main-parent">
    <?php require_once __DIR__  . '/../components/sideBar.php' ?>

    <?php  
      $page_title = "Cadastre seu produto";
      require_once __DIR__  . '/../components/headerTop.php' 
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
                <input type="file" name="file" id="inputFile" style="display: none;" >

                <button type="button" id="btn" onclick="openFile(event)">
                  <i id="iconBtn" class="bi bi-camera-fill"></i>
                </button>

                <span>Imagem do produto</span>
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
                      if(mysqli_num_rows($queryResult) > 0){
                        while($row = mysqli_fetch_assoc($queryResult)){
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
  <script src="../Assets/js/global.js"></script>
</body>


</html>