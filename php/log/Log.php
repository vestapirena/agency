<?php

include_once '../properties/ReadProp.php';

class Log
{
 
  private $_logFile;
  private $_path;
 
  function __construct()
  {
    $_prop = new ReadProp();
    $this->_path = $_prop->read('logpath');
    $this->_logFile = fopen($this->_path, "a");
  }
 
  function writeLine($type, $message)
  {
    $date = new DateTime();
    fputs($this->_logFile, "[" . $type . "][" . $date->format('d-m-Y H:i:s') . "]: " . $message . "\n");
  }
 
  function close()
  {
    fclose($this->_logFile);
  }
}
?>