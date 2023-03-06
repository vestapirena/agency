<?php

include_once '../log/Log.php';
include_once '../properties/ReadProp.php';
include_once '../connection/PDOConnection.php';

class DetailModel
{
  private $_outstanding;
  private $_products;
  private $_log;
  private $_pdoConnection;

  function __construct()
  {
    $this->_log = new Log();
    $this->_pdoConnection = new PDOConnection();
  }

  public function getDetailProduct($id)
  {
    try
    {
      $query = "SELECT id_product, model, specification, CONCAT('$', FORMAT(price, 2)) AS price, image FROM cpu_product WHERE id_product = :id_product ";
      $conn = $this->_pdoConnection->openConnection();
      $stmt = $conn->prepare($query);
      $stmt->bindValue(':id_product', $id, PDO::PARAM_INT);
      $stmt->execute();
      $this->_log->writeLine('INFO', 'getDetailProduct consulta realizada con éxito.');
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    catch (PDOException $e)
    {
      $this->_log->writeLine('ERROR', 'getDetailProduct error al realizar la consulta '.$e->getMessage());
      die($e->getMessage());
    }
  }

  public function getComment($id)
  {
    try
    {
      $query = 'SELECT comment, name, score FROM cpu_comment WHERE id_product = :id_product ORDER BY score DESC';
      $conn = $this->_pdoConnection->openConnection();
      $stmt = $conn->prepare($query);
      $stmt->bindValue(':id_product', $id, PDO::PARAM_INT);
      $stmt->execute();
      $this->_log->writeLine('INFO', 'getComment consulta realizada con éxito.');
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    catch (PDOException $e)
    {
      $this->_log->writeLine('ERROR', 'getComment error al realizar la consulta '.$e->getMessage());
      die($e->getMessage());
    }
  }

  public function updateMetaDataProduct($id)
  {
    try
    {
      $query = 'UPDATE cpu_product SET views = views + 1 WHERE id_product = :id_product ';
      $conn = $this->_pdoConnection->openConnection();
      $stmt = $conn->prepare($query);
      $stmt->bindValue(':id_product', $id, PDO::PARAM_INT);
      $stmt->execute();
      $this->_log->writeLine('INFO', 'updateMetaDataProduct consulta realizada con éxito.');
    }
    catch (PDOException $e)
    {
      $this->_log->writeLine('ERROR', 'updateMetaDataProduct error al realizar la actualización '.$e->getMessage());
      die($e->getMessage());
    }
  }

}


?>