<html>

<head>
  <link rel="stylesheet" href="../Assets/css/sideBar.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
  <div id="sidebar" class="sidebar">
    <div data-aos="fade-right" class="icons-sidebar">
      <div class="logo-container">
        <a href="../views/mainPage.php"><img id="logo" class="logo" src="../Assets/img/logo2.png" alt=""></a>
      </div>

      <div id="list" class="icon">
        <a id="link" href="#"><i id="icon-list" class="bi bi-list"></i></a>
      </div>


      <div id="sale" class="icon">
        <a id="link" class="link" href="../views/registerPage.php">
          <i id="icon" class="bi bi-check-circle"></i>
          <span>Vender</span>
        </a>
      </div>



      <div id="register" class="icon">
        <a id="link" class="link" href="../views/registerPage.php" ><i id="icon" class="bi bi-plus-circle"></i>
          <span>Cadastrar</span>
        </a>

      </div>

      <div id="historic" class="icon">
        <a id="link" class="link" href="../views/historic.php"><i id="icon" class="bi bi-book"></i>
          <span>Histórico</span>
        </a>

      </div>

      <div id="users" class="icon">
        <a id="link" class="link" href="#"><i id="icon" class="bi bi-people"></i>
          <span>Usuários</span>
        </a>

      </div>
    </div>
  </div>
  <script src="../Assets/js/sidebar.js"></script>
  <script>
  AOS.init();
</script>
</body>


</html>