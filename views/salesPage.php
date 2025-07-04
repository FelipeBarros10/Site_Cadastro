<?php require_once __DIR__ . "/../config/config.php" ?>
<?php require_once __DIR__ . "/../connect/connectionBd.php" ?>

<?php
$query = "SELECT * FROM produtos";
$queryResult = dbQuery($query);
$products = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

$searchProduct = $_GET['busca'] ?? '';

if($searchProduct){
  $querySearch = "SELECT * FROM produtos WHERE nome LIKE ?";
  $values = "%$searchProduct%";
  $queryResultSearch = dbQuery($querySearch, $values);

  $products = mysqli_fetch_all($queryResultSearch, MYSQLI_ASSOC);
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../Assets/css/salesPage.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="../vendor/alertifyjs/css/alertify.min.css" />
  <link rel="stylesheet" href="../vendor/alertifyjs/css/themes/default.min.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/cleave.js"></script>
  <script src="../vendor/alertifyjs/alertify.min.js"></script>
  <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
</head>

<body class="">
  <div class="main-parent">
    <?php require_once '../components/sideBar.php' ?>

    <?php
    $page_title = "Vender";
    require_once '../components/headerTop.php'
    ?>

    <main class="main-sales-content">
      <div class="products-content">
        <form action="salesPage.php" method="get">
          <div class="inputs-search-products">
            <input type="text" placeholder="Nome do produto" name="busca" value="<?php echo isset($_GET['busca']) ? $_GET['busca'] : '' ?>">
            <button><i class="bi bi-search"></i></button>
          </div>
        </form>

        <div class="title-products">
          <h2>Produtos</h2>
        </div>

        <div class="products-to-sale">
          <?php

          foreach ($products as $product) {
            echo
            "
                <div class='product' id='product' data-nome='{$product['NOME']}' data-preco='{$product['PRECO']}' data-id='{$product['ID']}'>
                    <div>
                      <img src='../Assets/img/{$product['IMAGENS']}'/>

                      <div class='product-name-value'>
                        <span>{$product['NOME']}</span>
                        <span class='price'>R$ {$product['PRECO']}</span>
                      </div>
                    </div>
                </div>
              ";
          }


          ?>

          <a href="registerPage.php" class="btn-add-product">
            <i class="bi bi-plus-lg"></i>
          </a>
        </div>
      </div>

      <div class="cart-content">
        <h3>Produtos no carrinho</h3>
        <div class="products-cart">
          <span id="warningTetxt">Nenhum item selecionado</span>
        </div>

        <div class="infos-cart">
          <div>
            <span id="sumItems">0</span>
            <span>items</span>
          </div>

          <div class="subtotal-cart">
            <span>Subtotal: </span>
            <span>R$ <span id="subtotal">0,00 </span></span>
          </div>
        </div>

        <div class="total-cart">
          <div>
            <span>Total:</span>
          </div>

          <div>
            <span>R$ <span id="total">0,00 </span></span>
          </div>
        </div>

        <div class="sell">
          <button class="">Vender</button>
        </div>
      </div>
    </main>
  </div>

  <script src="../Assets/js/salesPage.js"></script>
</body>