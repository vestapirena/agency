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
        $imageArr = array();
        if($categoryName=='Laptops')
        {
          $phrase = matchCategory($categoryName, $id_subcategory, $subcategoryName, 0, 9);
          $priceArr[0] = 7000;
          $priceArr[1] = 15000;
          $imageArr[0] = 1;
          $imageArr[1] = 10;
        } 
        else if ($categoryName=='Monitores')
        {
          $phrase = matchCategory($categoryName, $id_subcategory, $subcategoryName, 10, 19);
          $priceArr[0] = 1800;
          $priceArr[1] = 3200;
          $imageArr[0] = 11;
          $imageArr[1] = 20;
        }

        $model = $categoryName.' '.$subcategoryName;

        foreach($phrase as $sentence)
        {
          $specification = $sentence;
          $price = rand($priceArr[0],$priceArr[1]);
          $image = 'img/'.rand($imageArr[0],$imageArr[1]).'.png';
          $views = rand(10,500);
          $likes = rand(10,300);
          $product_insert->execute();
          $lastInsertId = $db->lastInsertId(); 
          echo '&nbsp;&nbsp;&nbsp;&nbsp;Id producto '.$lastInsertId.'<br>';
          $loop_comment = rand(0,15);
          for ($x = 0; $x <= $loop_comment; $x++) {
            //$comment = substr($lorem_ipsum,0,rand(5,300)); //Cantidad minima y maxima de texto en comentario
            shuffle($commentsArr);
            $n = rand(0,16);
            $phraseArr = array_slice($commentsArr, 0, $n);
            $comment = implode(" ",$phraseArr);
            $score = rand(1,5); //Cantidad minima y maxima de estrellas en calificacion
            $name = $names[rand(0,13)];
            $comment_insert->execute();
          } 
        }
      }
    }
  }
  catch (PDOException $e)
  {
    die($e->getMessage());
  }

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
  }

  function getComments()
  {
    $comments = array();
    $back = array();
    $data = file('comments.txt');
    $count = 0;
    foreach ($data as $value){
      $comments[] = $value;
      $count++;
    }
    return $comments;
  }

  echo 'Fin del proceso';

?>