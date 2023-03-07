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
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

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
  <div class="ui-widget search-box">
    <label for="search-box" >Buscar: </label>
    <input type="text" id="autocompletar" placeholder="asus"> 
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
  <script>
    $(document).ready(function() {
      $("#autocompletar").autocomplete({
        source: "http://localhost/agency/php/controllers/AutoCompleteController.php",
        minLength: 2,
        select: function( event, ui ) {
        event.preventDefault();
          showProduct(ui.item.id);
        }
      });
    });
</script>

  </body>
</html>