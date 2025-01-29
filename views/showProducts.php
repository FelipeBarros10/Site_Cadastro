<?php require_once __DIR__ . "/../config/config.php" ?>
<?php require_once __DIR__ . "/../connect/connectionBd.php" ?>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../Assets/css/showProducts.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
  <div class="main-parent">
    <?php include '../components/sideBar.php' ?>

    <?php
      $page_title = "Seu Produto";
      include '../components/headerTop.php'
      ?>

    <main class="main-register-content">
      
      <div class="col-md-10 offset-md-1">
        <div class="row">
          <div id="image-container" class="col-md-6">
            <img src="/img/events/{{ $events->image }}" class="img-fluid" alt="">
          </div>
          <div id="info-container" class="col-md-6">
            <h1></h1>
            <p class="event-city"><i class="bi bi-geo-alt-fill"></i> </p>
            <p class="events-participants"><i class="bi bi-people-fill"></i> Participantes</p>
            <p class="event-owner"><i class="bi bi-star"></i></p>
            <p class="already-joined-msg">Preseça já confirmada</p>

            <form action="/events/join/{{ $events->id }}" method="POST">
              <a href="" class="btn btn-primary" id="event-submit">Confirmar Presença</a>
            </form>
            <h3>O evento conta com:</h3>
            <ul id="items-list">
              <li><i class="bi bi-play"></i> <span></span></li>
            </ul>
          </div>
          <div class="col-md-12" id="description-container">
            <h3>Sobre o evento:</h3>
            <p class="event-description"></p>
          </div>
        </div>
      </div>
  </div>

  </main>


</body>