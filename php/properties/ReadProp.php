<?php

class ReadProp {

  function read($key) {
    $ini_array = parse_ini_file("prop.ini");
    return $ini_array[$key];
  }
    
}

?>