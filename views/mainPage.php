<?php require_once __DIR__ . "/../config/config.php" ?>
<?php require_once __DIR__ . "/../connect/connectionBd.php" ?>

<?php
$userId = $_SESSION["userId"];
$query = "SELECT * FROM produtos WHERE ID_USUARIO = ?";
$values = $userId;
$queryResult = dbQuery($query, $userId);
$products = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

$searchProduct = isset($_GET['busca']) ? $_GET['busca'] : '';
$searchProductCategorie = isset($_GET['filtros']) ? $_GET['filtros'] : '';

if ($searchProduct || $searchProductCategorie) {
  if ($searchProduct) {
    $querySearch = "SELECT * FROM produtos WHERE nome LIKE ? AND ID_USUARIO = ?";
    $values = ["%$searchProduct%", $userId];
    $querySearchResult = dbQuery($querySearch, $values);
  } else {
    $querySearch = "SELECT produtos.NOME, produtos.QUANTIDADE_ESTOQUE, produtos.PRECO, produtos.IMAGENS, produtos.CUSTO, produtos.ID_CATEGORIAS, produtos.ID FROM produtos 
     INNER JOIN categorias ON categorias.ID = produtos.ID_CATEGORIAS
     WHERE categorias.NOME LIKE ? AND ID_USUARIO = ?";
    $values = ["%$searchProductCategorie%", $userId];
    $querySearchResult = dbQuery($querySearch, $values);
  }

  $products = mysqli_fetch_all($querySearchResult, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../Assets/css/mainPage.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
  <div class="main-parent">
    <?php include '../components/sideBar.php' ?>
    <main class="main-register-content">
      <?php
      $page_title = "Produtos";
      include '../components/headerTop.php'
      ?>
      <!--Início Subtítulo-->
      <div data-aos="fade-right" class="header-inputs">
        <form method="get" action="mainPage.php" id="form" onSubmit="loadingContent()">
          <div class="inputs-search-subtitle">
            <input type="text" placeholder="Pesquise o nome" id="busca" name="busca" value="<?php echo isset($_GET['busca']) ? $_GET['busca'] : ''; ?>">
            <button type="button" onclick="loadingContent()"><i class="bi bi-search"></i></button>
          </div>
        </form>

        <div class="inputs-select-subtitle">
          <div class="icon-select">
            <i class="bi bi-funnel"></i>
          </div>

          <form id="formSelect" action="mainPage.php" method="get">
            <select name="filtros" value="filtros" id="selectCategorie" onchange="filterCategorie()">
              <option value="" <?php echo empty($_GET['filtros']) ? 'selected' : ''; ?>>Todos</option>
              <?php
              $queryCategories = "SELECT categorias.NOME FROM categorias
                INNER JOIN produtos ON categorias.ID = produtos.ID_CATEGORIAS
                WHERE produtos.ID_USUARIO = ?
                ";
              $Values = $userId;
              $queryResultCategories = dbQuery($queryCategories, $values);


              $categories = mysqli_fetch_all($queryResultCategories, MYSQLI_ASSOC);

              foreach ($categories as $categorie) {
                $categorieName = $categorie['NOME'];
                $isSelected = ($categorieName === $_GET['filtros']) ? 'selected' : '';
                echo "
                    <option value='{$categorie['NOME']}'{$isSelected}>{$categorie['NOME']}</option>
                  ";
              }
              ?>
            </select>
          </form>
        </div>

        <div class="inputs-plus-product-subtitle">
          <a href="./registerPage.php">
            <i class="bi bi-plus-lg"></i>
            <span>Produto</span>
          </a>
        </div>
      </div>
      <!--Fim Subtítulo-->

      <!--Início do Segundo Subtítulo-->
      <div data-aos="fade-left" class="header-information-stock">

        <div class="value-stock">

          <?php
          $query = "SELECT SUM(PRECO), SUM(CUSTO) FROM produtos";
          $queryResult = dbQuery($query);

          if ($value = mysqli_fetch_assoc($queryResult)) {

            $predictedProfit = $value['SUM(PRECO)'] - $value['SUM(CUSTO)'];
            $stockValue = str_replace([".", " "], [",", ","], $value);
          }
          ?>
          <h4>R$ <?php echo $stockValue['SUM(PRECO)'] ?></h4>
          <span>Valor em estoque</span>
        </div>

        <div class="cost-stock">
          <h4>R$ <?php echo $stockValue['SUM(CUSTO)'] ?></h4>
          <span>Custo do estoque</span>
        </div>

        <div class="profit-stock">
          <h4>R$ <?php echo number_format($predictedProfit, 2, ",", ".") ?></h4>
          <span>Lucro Previsto</span>
        </div>
      </div>
      <!--Fim Segundo Subtítulo-->

      <?php

      if (count($products) != 0) {

        echo
        "
        <div data-aos='fade-up' class='main-table-products'>
          <div class='loading' id='loading'>
          <dotlottie-player src='https://lottie.host/33022999-343c-4490-b368-1fd709b0081b/2ax7KO5izZ.lottie' background='transparent' speed='3' style='width: 50%; height: 50%' direction='1' playMode='forward' loop autoplay></dotlottie-player>
         </div>
          <div>
          <table class='table-products'>
          <thead class='table-header'
          <tr>
          <th>Produto</th>
          <th>Categoria</th>
          <th>Estoque</th>
          <th>Preço</th>
          <th></th>
          </tr>
          </thead>
        ";

        foreach ($products as $product) {
          $queryInnerJoin = "SELECT categorias.NOME FROM categorias
            INNER JOIN produtos ON categorias.ID = produtos.ID_CATEGORIAS WHERE categorias.ID = ?";

          $values = $product["ID_CATEGORIAS"];

          $queryInnerJoinResult = dbQuery($queryInnerJoin, $values);

          $categorieRow = mysqli_fetch_assoc($queryInnerJoinResult);

          $categorieName = $categorieRow["NOME"];

          $product['PRECO'] = str_replace(".", ",", $product['PRECO']);
          echo
          "
            <tbody class='table-body'>
              <tr>
                <td>
                  <a class='column-product' href='showProducts.php?id={$product['ID']}'>
                    <img class='image-product' src='./../Assets/img/{$product['IMAGENS']}' />
                    <span>{$product['NOME']}</span>
                  </a>
                </td>
                <td>$categorieName</td>
                <td>{$product['QUANTIDADE_ESTOQUE']}</td>
                <td>{$product['PRECO']}</td>
                <td>
                  <form action='../controller/handleDeleteProducts.php' method='post'>
                    <input type='hidden' name='product_id' value='{$product['ID']}'>
                    <button class='btn'><i class='bi bi-trash'></i></button>
                  </form>
                </td>
                <td>
                  <a class='column-product' href='showProducts.php?id={$product['ID']}'>
                    <button class='btn'><i class='bi bi-pencil-square'></i></button>
                  </a>
                </td>
              </tr>
            </tbody>
          ";
        }
        echo
        "
          </table>
          </div>
          </div>
        ";
      }

      ?>
    </main>
  </div>
</body>
<script src="../Assets/js/global.js"></script>>
<script src="../Assets/js/stylingInputPrice.js"></script>
<script src="../Assets/js/loadingPageAnimation.js"></script>
<script src="../Assets/js/mainPage.js"></script>
<script>
  AOS.init();
</script>

</html>