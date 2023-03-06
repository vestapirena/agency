<?php

include_once '../connection/PDOConnection.php';
include_once '../log/Log.php';

class CategoryModel
{
  private $_log;
  private $_pdoConnection;

  function __construct()
  {
    $this->_log = new Log();
    $this->_pdoConnection = new PDOConnection();
  }

  public function getCategory()
  {
    try
    {
      $response = array();
      $category_query = 'SELECT id_category, category FROM cpu_category ';
      $conn = $this->_pdoConnection->openConnection();
      $stmt_category = $conn->prepare($category_query);
      $stmt_category->execute();
      $id_category = 0;
      $subcategory_query = 'SELECT id_subcategory, subcategory FROM cpu_subcategory WHERE id_category = :id_category';
      $stmt_subcategory = $conn->prepare($subcategory_query);
      $stmt_subcategory->bindParam(':id_category', $id_category);
      while($category = $stmt_category->fetch(PDO::FETCH_ASSOC)) {
        $id_category = $category['id_category'];
        $this->_log->writeLine('INFO', 'categorias '.$id_category );
        $stmt_subcategory->execute();
        $response[] = array('id_category'=> $category['id_category'], 'category'=> $category['category'], 'subcategory'=>$stmt_subcategory->fetchAll(PDO::FETCH_OBJ));
      }
      $this->_log->writeLine('INFO', 'getCategory Consulta realizada con éxito.');
      return $response;
    }
    catch (PDOException $e)
    {
      $this->_log->writeLine('ERROR', 'getCategory Error al realizar la consulta '.$e->getMessage());
      die($e->getMessage());
    }
  }

  public function getCategoryById($id)
  {
    try
    {
      $category = '';
      $query = 'SELECT category FROM cpu_category WHERE id_category = :id_category';
      $conn = $this->_pdoConnection->openConnection();
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':id_category', $id);
      if($stmt->execute())
      {
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $category = $row->category;
        $this->_log->writeLine('INFO', 'getCategoryById Consulta realizada con éxito Categoria '.$category);
      }
      else
      {
        $category = '';
      }
      return $category;
    }
    catch (PDOException $e)
    {
      $this->_log->writeLine('ERROR', 'getCategoryById Error al realizar la consulta '.$e->getMessage());
      die($e->getMessage());
    }
  }

}

?>