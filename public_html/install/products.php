<?php

  echo 'Los productos se insertan mediante las subcategorias registradas y la configuración del archivo data.txt<br>';
  echo 'Los comentarios estan en el archivo comment.txt<br><br>';
  $db;
  //Conexión con control de errores
  $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
  try {
    $db = new PDO('mysql:host=localhost;dbname=agency', 'root', '', $opciones);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
  }

  try
  {

    $category_query = 'SELECT id_category, category FROM cpu_category ';
    $stmt_category = $db->prepare($category_query);
    $stmt_category->execute();
    $id_category = 0;
    $subcategory_query = 'SELECT id_subcategory, subcategory FROM cpu_subcategory WHERE id_category = :id_category';
    $stmt_subcategory = $db->prepare($subcategory_query);
    $stmt_subcategory->bindParam(':id_category', $id_category);

    //Cantidad de productos a ingresar por subcategoria
    $amountProducts = 9;
    //Insertar productos
    $product_insert_sql = "INSERT INTO cpu_product (id_product, id_subcategory, model, specification, price, image, registration_date, modification_date, views, likes) VALUES (NULL, :id_subcategory, :model, :specification, :price, :image, NOW(), NOW(), :views, :likes)";
    $product_insert = $db->prepare($product_insert_sql);
    $product_insert->bindParam(':id_subcategory', $id_subcategory);
    $product_insert->bindParam(':model', $model);
    $product_insert->bindParam(':specification', $specification);
    $product_insert->bindParam(':price', $price);
    $product_insert->bindParam(':image', $image);
    $product_insert->bindParam(':views', $views);
    $product_insert->bindParam(':likes', $likes);

    //Cargar comentarios
    $commentsArr = getComments();
    //Cargar nombres
    $namesArr = getNames();
    $countNames = count($namesArr);
    $countNames--;
    //Insertar comentarios
    //variable ciclos por comentario
    $loop_comment=0;
    //Variable aleatoria calificacion
    $score = 1;
    //Se recorre por producto registrado
    $lastInsertId = 1;
    //Nombres
    $names = array('Jenifer','Maira','Beatriz','Jaqueline','Monica','Alejandra','Sandra','Mar','Fatima','Lidia','Joel','Pascual','Francisco','Alberto');
    //Comentario que se insertara al final
    $comment = '';
    $comment_insert_sql = "INSERT INTO cpu_comment (id_comment, id_product, comment, name, score) VALUES (NULL, :id_product, :comment, :name, :score)";
    $comment_insert = $db->prepare($comment_insert_sql);
    $comment_insert->bindParam(':id_product', $lastInsertId);
    $comment_insert->bindParam(':comment', $comment);
    $comment_insert->bindParam(':name', $name);
    $comment_insert->bindParam(':score', $score);

    while($category = $stmt_category->fetch(PDO::FETCH_ASSOC)) {
      $id_category = $category['id_category'];
      $categoryName = $category['category'];
      echo 'Categoria '.$categoryName.'<br>';
      $stmt_subcategory->execute();
      while($subcategory = $stmt_subcategory->fetch(PDO::FETCH_ASSOC)) {
        
        $id_subcategory = $subcategory['id_subcategory'];
        $subcategoryName = $subcategory['subcategory'];
        echo '&nbsp;&nbsp;Subcategoria '.$subcategoryName.'<br>';
        $phrase = '';
        $priceArr = array();

        $productArr = matchCategory($categoryName); 
        $priceFirst = $productArr[0];
        $priceValues = explode(',', $priceFirst); 
        array_shift($productArr);
        for ($j = 0; $j <= $amountProducts; $j++) 
        {
          $model = $categoryName.' '.$subcategoryName.' - '.getModel();
          $co = rand(5,10);
          shuffle($productArr);
          shuffle($productArr);
          $product = array_slice($productArr, 1, $co);// error$$phrase[0];
          $specification = implode(" ",$product);
          $price = rand((int)$priceValues[0],(int)$priceValues[1]);
          $image = 'img/'.$categoryName.'/'.rand(1,10).'.png';
          $views = rand(10,500);
          $likes = rand(10,300);
          $product_insert->execute();
          $lastInsertId = $db->lastInsertId(); 
          echo '&nbsp;&nbsp;&nbsp;&nbsp;Id producto '.$lastInsertId.' Modelo '.$model.'<br>';
          $loop_comment = rand(1,10);
          for ($x = 0; $x <= $loop_comment; $x++) 
          {
            if($x % 2 == 0)
            {
              sort($commentsArr);
              shuffle($commentsArr);
            }
            else
            {
              rsort($commentsArr);
              shuffle($commentsArr);
            }
            
            shuffle($namesArr);
            $n = rand(2,6);
            $phraseArr = array_slice($commentsArr, 1, $n);
            $comment = implode(" ",$phraseArr);
            $score = rand(1,5); //Cantidad minima y maxima de estrellas en calificacion
            $name = $namesArr[rand(0,$countNames)];
            $comment_insert->execute();
            $comment='';
          } 
        }
      }
    }
  }
  catch (PDOException $e)
  {
    die($e->getMessage());
  }

  function matchCategory($file)
  {
    $category = array();
    $data = file($file.'.txt');
    foreach ($data as $value){
      $category[] = $value;
    }
    return $category;
  }

  /*
  function matchCategory($categoryName, $id_subcategory, $subcategory, $begin, $end)
  {
    $characteristics = array();
    $back = array();
    $data = file('data.txt');
    for($i = $begin; $i < $end; $i++){
      $characteristics[] = $data[$i];
    }
    
    $phrase = '';
    for($j = 0; $j < 10; $j++){
      shuffle($characteristics);
      $phrase = implode(" ",$characteristics);
      $back[] = $phrase;
    }
    return $back;
  }*/

  function getComments()
  {
    $comments = array();
    $data = file('comments.txt');
    foreach ($data as $value){
      $comments[] = $value;
    }
    return $comments;
  }

  function getModel()
  {
    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), rand(4,9), rand(10,15));
  }

  function getNames()
  {
    $names = array();
    $data = file('names.txt');
    foreach ($data as $value){
      $names[] = $value;
    }
    return $names;
  }
 

  // Output: 54esmdr0qf
  
  //echo substr(str_shuffle($permitted_chars), 0, 10);
  


  echo 'Fin del proceso';

?>