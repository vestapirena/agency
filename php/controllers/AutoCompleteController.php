<?php

  header('Content-type: application/json; charset=utf-8');
  include_once '../models/AutoCompleteModel.php';
  $request_method=$_SERVER['REQUEST_METHOD'];
  
  switch($request_method)
  {
    case 'GET':
      // Retrive Products By Sub Id
      if(!empty($_GET['term']))
      {
        $term=$_GET['term']; 
        searchTerm($term);
      }
      else
      {
        // Invalid Request Method
        header('HTTP/1.0 405 Method Not Allowed');
      }
      break;
    case 'POST':
      getMethodPost();
      break;
    default:
      // Invalid Request Method
      header('HTTP/1.0 405 Method Not Allowed');
      break;
  }

  function searchTerm($term)
  {
    $response = array();
    $autoCompleteModel = new AutoCompleteModel();
    $data = $autoCompleteModel->searchTerm($term);
    echo json_encode($data);
  }

?>