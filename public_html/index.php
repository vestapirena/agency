<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agency</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/random.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/spinner.css">
    <link rel="stylesheet" href="css/nav.css">
  </head>
  <body>
<br>
  <div class="menu-random" id="menu-random">Productos Destacados
    <button type="button" class="button" id="randomSpinner" onclick="getRandomProducts();">
      <span class="button__text">Refrescar</span>
    </button>
  </div>
  <div class="random">
    <i id="left" class="ctrl-btn prev" style="display: block;">Previo</i>
    <div class="carousel">
      <ul id="random-product">
      </ul>
    </div>
    <i id="right"  class="ctrl-btn next" style="display: block;">Siguiente</i>
  </div>
  <br>
  <div class = "header" id="header">
    <ul class="nav">
      <li><a href="">Categorias</a>
        <ul id="nav">
        </ul>
      </li>
    </ul>
  </div>


  <div class="shop" id="shop">
  </div>


  <script src="js/index.js"></script>
  <script src="js/random.js"></script>

  </body>
</html>