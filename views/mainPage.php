<?php require_once __DIR__ . "/../config/config.php" ?>
<?php require_once __DIR__ . "/../connect/connectionBd.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../Assets/css/mainPage.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
      <div class="header-inputs">
        <div class="inputs-search-subtitle">
          <input type="text" placeholder="Pesquise">
          <button><i class="bi bi-search"></i></button>
        </div>

        <div class="inputs-select-subtitle">
          <div class="icon-select">
            <i class="bi bi-funnel"></i>
          </div>

          <form action="">
            <select name="filtros" id="">
              <option value="">Filtros</option>
              <option value="sim">Sim</option>
              <option value="nao">Não</option>
            </select>
          </form>
        </div>

        <div class="inputs-plus-product-subtitle">
          <button>
            <i class="bi bi-plus-lg"></i>
            <span>Produto</span>
          </button>
        </div>
      </div>
      <!--Fim Subtítulo-->

      <!--Início do Segundo Subtítulo-->
      <div class="header-information-stock">
        <div class="value-stock">
          <h4>R$ 000.000,0</h4>
          <span>Valor em estoque</span>
        </div>

        <div class="cost-stock">
          <h4>R$ 000.000,0</h4>
          <span>Custo do estoque</span>
        </div>

        <div class="profit-stock">
          <h4>R$ 000.000,0</h4>
          <span>Lucro Previsto</span>
        </div>
      </div>
      <!--Fim Segundo Subtítulo-->
      
      <?php
        $query = "SELECT * FROM produtos";
        $queryResult = dbQuery($query);


        if (mysqli_num_rows($queryResult) > 0) {

          while ($row = mysqli_fetch_assoc($queryResult)) {

            $queryInnerJoin = "SELECT categorias.NOME FROM categorias
            INNER JOIN produtos ON categorias.ID = produtos.ID_CATEGORIAS WHERE categorias.ID = ?";

            $values = $row["ID_CATEGORIAS"];

            $queryInnerJoinResult = dbQuery($queryInnerJoin, $values);

            $categorieName = implode(mysqli_fetch_assoc($queryInnerJoinResult));
                  
              echo"<div class='main-table-products'>";
                echo"<div>";
                  echo"<table class='table-products'>";
                    echo"<thead class='table-header'";
                        echo"<tr>";
                        echo"<th>Produto</th>";
                        echo"<th>Categoria</th>";
                        echo"<th>Estoque</th>";
                        echo"<th>Preço</th>";
                        echo"<th></th>";
                        echo "</tr>";
                    echo"</thead>";

                      echo"<tbody class='table-body'>";
                          echo "<tr>";

                            echo "<td><a class='column-product' href='showProducts.php?id={$row['ID']}'>
                                        <img class='image-product' src='./../Assets/img/{$row['IMAGENS']}' />
                                        <span>{$row['NOME']}</span>
                                      </a>
                                  </td>";
                            echo "<td>$categorieName</td>";
                            echo "<td>{$row['QUANTIDADE_ESTOQUE']}</td>";
                            echo "<td>{$row['PRECO']}</td>";
                            echo "<td>
                                    <form action='../controller/handleDeleteProducts.php' method='post' class=''>
                                      <input type='hidden' name='product_id' value='{$row['ID']}'>
                                      <button class='btn'><i class='bi bi-trash'></i></button>
                                    </form>
                                  </td>";
                          echo "</tr>";
                      echo"</tbody>";
                    echo "</table>";
                  echo"</div>";
                 echo"</div>";
                }
              }
            ?>

      
    </main>
  </div>
</body>
<script src="../Assets/js/mainPage.js"></script>

</html>
