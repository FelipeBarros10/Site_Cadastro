<?php require_once __DIR__ . "/../config/config.php" ?>
<?php require_once __DIR__ . "/../connect/connectionBd.php" ?>

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
        <div class="inputs-search-products">
          <input type="text" placeholder="Nome do produto">
          <button><i class="bi bi-search"></i></button>
        </div>

        <div class="title-products">
          <h2>Produtos</h2>
        </div>

        <div class="products-to-sale">
          <?php 
            $query = 'SELECT * FROM produtos';
            $queryResult = dbQuery($query);

            while($row = mysqli_fetch_assoc($queryResult)){
              echo "
                <div class='product' id='product' data-nome='{$row['NOME']}' data-preco='{$row['PRECO']}' data-id='{$row['ID']}'>
                    <div>
                      <img src='../Assets/img/{$row['IMAGENS']}'/>

                      <div class='product-name-value'>
                        <span>{$row['NOME']}</span>
                        <span id='price'>R$ {$row['PRECO']}</span>
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
        <h3>Selecionar cliente</h3>
        <div class="products-cart">
          <span id="warningTetxt">Nenhum item selecionado</span>
        </div>
      </div>
    </main>
  </div>

  <script src="../Assets/js/global.js"></script>

  <script src="../Assets/js/salesPage.js"></script>
</body>