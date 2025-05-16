<html>

<head>
  <link rel="stylesheet" href="../Assets/css/sideBar.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
  <div id="sidebar" class="sidebar">
    <div data-aos="fade-right" class="icons-sidebar">
      <!-- <div class="logo-container">
        <a href="../views/mainPage.php"><img id="logo" class="logo" src="../Assets/img/logo2.png" alt=""></a>
      </div> -->

      <a href="../views/mainPage.php">
        <div class="logo-container">
          <img id="logo" class="logo" src="../Assets/img/logo2.png" alt=""></a>
        </div>
      </a>

      <!-- <div id="list" class="icon">
      <i id="icon-list" class="bi bi-list"></i>
        
      </div> -->

      <a id="linkList" href="#">
        <div id="list" class="parentIcon">
          <i id="icon-list" class="bi bi-list"></i>
        </div>
      </a>

      <a id="linkSale" class="link" href="../views/salesPage.php"><!---->
        <div class="parentIcon">
          <i id="icon" class="bi bi-check-circle"></i>
          <span>Vender</span> 
        </div>    
      </a>

      <a id="linkRegister" class="link" href="../views/registerPage.php">
        <div class="parentIcon">
          <i id="icon" class="bi bi-plus-circle"></i>
          <span>Cadastrar</span>
        </div>
      </a>

      <a id="linkHistoric" class="link" href="../views/historic.php">
        <div class="parentIcon">
          <i id="icon" class="bi bi-book"></i>
          <span>Histórico</span>'
        </div>
      </a>
      
      <a id="linkUsers" class="link" href="#">
        <div class="parentIcon">
          <i id="icon" class="bi bi-people"></i>
          <span>Usuários</span>
        </div>  
      </a>
      
    </div>
  </div>
  <script src="../Assets/js/sidebar.js"></script>
  <script>
  AOS.init();
</script>
</body>


</html>