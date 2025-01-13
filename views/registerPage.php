<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../Assets/css/registerPage.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
  <div class="main-parent">
    <?php include '../components/sideBar.php' ?>

    <?php include '../components/registerPage/headerRegisterPage.php' ?>

    <main class="main-register-content">


      <div class="main-register-products">
        <div class="register-inputs">
          <div class="first-content-inputs">
            <div class="input-name-product">
              <label>Nome do produto</label>
              <input type="text" name="text" id="">
            </div>

            <div class="button-img-product">
              <input type="file" name="file" id="file" style="display: none;">
              <button id="btn" onclick="openFile()">
                <i class="bi bi-camera-fill"></i>
              </button>

              <span>Imagem do produto</span>
            </div>
          </div>

          <div class="second-content-input">
            <div class="input-price-stock-product">
              <div class="input-price">
                <label>Preço</label>
                <input type="text" name="text" id="">
              </div>

              <div class="input-stock">
                <label>Quantidade</label>
                <input type="text" name="text" id="">
              </div>

              <div class="button-register">
                <button>Cadastrar</button>
              </div>
            </div>

            <div class="input-category-product">
              <div class="select-category">
                <label>Selecione a categoria</label>
                <select name="" id="">
                  <option value="">Categoria do produto</option>
                </select>
              </div>

              <div class="input-new-category">
                <label>Nova categoria</label>
                <input type="text" name="text" id="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

</body>
<script src="../Assets/js/registerPage.js"></script>

</html>