<?php

include_once '../properties/ReadProp.php';
include_once '../log/Log.php';

class PDOConnection
{

  private $_connection;
  private $_hn;
  private $_db;
  private $_us;
  private $_se;
  private $_ch;
  private $_log;
  
  function __construct()
  {
    $this->_log = new Log();
    $prop = new ReadProp();
    $this->_hn = $prop->read('hostname');
    $this->_db = $prop->read('database');
    $this->_us = $prop->read('user');
    $this->_se = $prop->read('secret');
    $this->_ch = $prop->read('charset');
    $this->_log->writeLine('INFO', "Parámetros de conexión ok.");
  }
  
  public function openConnection()
  {
    try 
    {
      $options = array();
      $this->_connection = new PDO('mysql:host='.$this->_hn.';dbname='.$this->_db.';charset='.$this->_ch, $this->_us, $this->_se, $options);
      $this->_log->writeLine('INFO', "Conexión realizada con éxito.");
      return $this->_connection;
    }
    catch (PDOException $e) 
    {
      $this->_log->writeLine('ERROR', "Error al realizar la conexión ".$e->getMessage());
      die();
    }
  }
  
}
?>