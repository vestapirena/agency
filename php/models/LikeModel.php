<?php

include_once '../log/Log.php';
include_once '../properties/ReadProp.php';
include_once '../connection/PDOConnection.php';

class LikeModel
{
  private $_log;
  private $_pdoConnection;

  function __construct()
  {
    $this->_log = new Log();
    $this->_pdoConnection = new PDOConnection();
  }

  public function setLike($id)
  {
    try
    {
      $query = 'UPDATE cpu_product SET likes = likes + 1 WHERE id_product = :id_product ';
      $conn = $this->_pdoConnection->openConnection();
      $stmt = $conn->prepare($query);
      $stmt->bindValue(':id_product', $id, PDO::PARAM_INT);
      $stmt->execute();
      $this->_log->writeLine('INFO', 'setLike consulta realizada con éxito.');
      return 'ok';
    }
    catch (PDOException $e)
    {
      $this->_log->writeLine('ERROR', 'setLike error al realizar la actualización '.$e->getMessage());
      die($e->getMessage());
    }
  }

}


?>