<?php

include_once '../log/Log.php';
include_once '../properties/ReadProp.php';
include_once '../connection/PDOConnection.php';

class AutoCompleteModel
{
  private $_log;
  private $_pdoConnection;

  function __construct()
  {
    $this->_log = new Log();
    $this->_pdoConnection = new PDOConnection();
  }

  public function searchTerm($search)
  {
    try
    {
      $query = 'SELECT id_product, model FROM cpu_product WHERE model LIKE :search LIMIT 10';
      $conn = $this->_pdoConnection->openConnection();
      $stmt = $conn->prepare($query);
      $stmt->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
      $stmt->execute();
      $this->_log->writeLine('INFO', 'searchTerm consulta realizada con éxito. '.$search);
      $skillData = array();
      while($category = $stmt->fetch(PDO::FETCH_ASSOC)) 
      {
        $data['id'] = $category['id_product'];
        $data['value'] = $category['model'];
        array_push($skillData, $data);
      }
      return $skillData;
    }
    catch (PDOException $e)
    {
      $this->_log->writeLine('ERROR', 'searchTerm error al realizar la actualización '.$e->getMessage());
      die($e->getMessage());
    }
  }

}


?>