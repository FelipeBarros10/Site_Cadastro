<?php require_once __DIR__ . "/../config/config.php"?>
<?php require_once __DIR__ . "/../connect/connectionBd.php"?>
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
      <?php include '../components/mainPage/header.php' ?>

      <div class="main-table-products">
        <div>
          <table class="table-products">
            <thead class="table-header">
              <tr>
                <th>Produto</th>
                <th>Categoria</th>
                <th>Estoque</th>
                <th>Preço</th>
                <th></th>
              </tr>
            </thead>

            <tbody class="table-body">
              
                <?php 
                  $query = "SELECT * FROM produtos";
                  $queryResult = dbQuerySelect($query);

                
                  if(mysqli_num_rows($queryResult) > 0){

                    while($row = mysqli_fetch_assoc($queryResult)){

                      $queryInnerJoin = "SELECT categorias.NOME FROM categorias
                      INNER JOIN produtos ON categorias.ID = produtos.ID_CATEGORIA WHERE categorias.ID = ?";

                      $values = $row["ID_CATEGORIA"];

                      $queryInnerJoinResult = dbQuerySelect($queryInnerJoin, $values);

                      $categorieName = implode(mysqli_fetch_assoc($queryInnerJoinResult));

                      echo "<tr>";
                      echo "<td><a class='column-product' href=''>
                                <img class='image-product' src='./../Assets/img/{$row['IMAGENS']}' 
                                <span>{$row['NOME']}</span>
                                </a>
                            </td>";
                      echo "<td>$categorieName</td>";
                      echo "<td>{$row['QUANTIDADE_ESTOQUE']}</td>";
                      echo "<td>{$row['PRECO']}</td>";
                      echo "<td><button class='btn'><i class='bi bi-trash'></i></button></td>";
                      echo "</tr>";
                    }
                  }
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

</body>
<script src="../Assets/js/mainPage.js"></script>

</html>