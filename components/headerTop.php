<html>

<head>
  <link rel="stylesheet" href="./../Assets/css/header.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
  <!--Início Título-->
  <div class="main-header">
    <div data-aos="fade-down" class="title-content">
      <div>
        <h1><?php echo $page_title ?></h1>
      </div>

      <div class="perfil-content">
        <div class="input-logout">
          <form action="../controller/logout.php" method="post">
            <input type="submit" value="Sair" name="logout">
          </form>
        </div>

        <div class="image-content">
          <div class="image">
            <?php
            $userId = $_SESSION["userId"];
            $query = "SELECT * FROM cadastro_usuarios WHERE ID = ?";
            $values = $userId;

            $result = dbQuery($query, $values);

            if (mysqli_num_rows($result) > 0) {
              $userImage = mysqli_fetch_assoc($result);

              if ($userImage['IMAGEM_PERFIL']) {
                echo "<img src='./../Assets/img/{$userImage['IMAGEM_PERFIL']}'>";
              } else {
                echo "<img src='./../Assets/img/iconeUser.png'>";
              }
            }
            ?>
          </div>
        </div>

        <div>

          <?php echo "<h4 class='user-name'>{$userImage['NOME']}</h4>" ?>
          <?php echo "<span class='user-email'>{$userImage['EMAIL']}</span>" ?>
        </div>
      </div>
    </div>
    <!--Fim Título-->
    <script>
      AOS.init();
    </script>
</body>

</html>