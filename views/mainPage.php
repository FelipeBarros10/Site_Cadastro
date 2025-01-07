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
              <tr>
                <td>
                  <div >
                    <a class="column-product" href="">
                      <img class="image-product" src="./../Assets/img/camiseta.jpeg" alt="">
                      <span>Camisetas polo - pacote com 3</span>
                    </a>
                  </div>
                </td>
                <td>Acessórios</td>
                <td>50</td>
                <td>R$ 100,00</td>
                <td><button class="btn"><i class="bi bi-trash"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

</body>
<script src="../Assets/js/mainPage.js"></script>

</html>