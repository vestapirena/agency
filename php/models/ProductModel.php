<?php

include_once '../log/Log.php';
include_once '../properties/ReadProp.php';
include_once '../connection/PDOConnection.php';

class ProductModel
{
  private $_outstanding;
  private $_products;
  private $_log;
  private $_pdoConnection;

  function __construct()
  {
    $prop = new ReadProp();
    $this->_outstanding = $prop->read('outstandinglimit');
    $this->_products = $prop->read('productslimit');
    $this->_log = new Log();
    $this->_pdoConnection = new PDOConnection();
  }

  public function getProducBySubCategory($id)
  {
    try
    {
      $query = "SELECT id_product, LEFT(model, 40) as model, LEFT(specification, 60) as specification, CONCAT('$', FORMAT(price, 2)) AS price, image FROM cpu_product WHERE id_subcategory = :id_subcategory ORDER BY model LIMIT 0, :limit";
      $conn = $this->_pdoConnection->openConnection();
      $stmt = $conn->prepare($query);
      $stmt->bindValue(':id_subcategory', $id, PDO::PARAM_INT);
      $stmt->bindValue(':limit', $this->_products, PDO::PARAM_INT);
      $stmt->execute();
      $this->_log->writeLine('INFO', "getProducBySubCategory consulta realizada con éxito.");
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    catch (PDOException $e)
    {
      $this->_log->writeLine('ERROR', "getProducBySubCategory error al realizar la consulta ".$e->getMessage());
      die($e->getMessage());
    }
  }

  public function getRandomProducts()
  {
    try
    {
      $query = "SELECT id_product, LEFT(model, 16) as model, specification, CONCAT('$', FORMAT(price, 2)) AS price, image FROM cpu_product ORDER BY RAND() LIMIT 0, :limit ";
      $conn = $this->_pdoConnection->openConnection();
      $stmt = $conn->prepare($query);
      $stmt->bindValue(':limit', $this->_outstanding, PDO::PARAM_INT);
      $stmt->execute();
      $this->_log->writeLine('INFO', 'getRandomProducts consulta realizada con éxito.');
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    catch (PDOException $e)
    {
      $this->_log->writeLine('ERROR', 'getRandomProducts error al realizar la consulta '.$e->getMessage());
      die($e->getMessage());
    }
  }

}

?>