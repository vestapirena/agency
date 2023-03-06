<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agency detail</title>
    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/spinner.css">

  </head>
  <body>

    <div id="container" class="container">
      <div class="product">
        <div class="product-img">
          <img src="img/comming-soon.png" id="image" class="image">
        </div>
        <div class="product-listing">
            <div class="content">
                <h1 class="name" id="model">0000</h1>
                <p class="info" id="specification">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <p class="price" id="price">0000</p>
                <div class="btn-and-rating-box">
                  <button type="button" class="button" id="randomSpinner" onclick="setLike();">
                    <span class="button__text">Like</span>
                  </button>
                  <button class="btn" onclick="back();">Regresar</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    <input type="hidden" id="txtLike">

    <br>
    <div class="p_container" id="comments">
      <div class="comment">
        <div class="p_name">Cargando</div>
        <div class="p_comment">Cargando</div>
        <div class="rating">
          <img src="img/star_drawn.png">
          <img src="img/star_drawn.png">
          <img src="img/star_drawn.png">
          <img src="img/star_drawn.png">
          <img src="img/star_drawn.png">
        </div>
      <div>
    </div>


    <script src="js/detail.js"></script>
  </body>
</html>