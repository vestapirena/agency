<?php

  header('Content-type: application/json; charset=utf-8');
  include_once '../models/CategoryModel.php';
  $request_method=$_SERVER['REQUEST_METHOD'];

  switch($request_method)
  {
    case 'GET':
      // Retrive Category
      getCategory();
      break;
    default:
      // Invalid Request Method
      header('HTTP/1.0 405 Method Not Allowed');
      break;
  }

  function getCategory()
  {
    $categoryModel = new CategoryModel();
    $res = $categoryModel->getCategory();
    echo json_encode($res);
  }

?>