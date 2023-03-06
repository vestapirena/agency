<?php

  header('Content-type: application/json; charset=utf-8');
  include_once '../models/DetailModel.php';
  $request_method=$_SERVER['REQUEST_METHOD'];

  switch($request_method)
  {
    case 'GET':
      // Retrive Products
      if(!empty($_GET['id']))
      {
        $id=intval($_GET['id']);
        getDetailProduct($id);
      }
      else
      {
        header('HTTP/1.0 405 Method Not Allowed');
      }
      break;
    default:
      // Invalid Request Method
      header('HTTP/1.0 405 Method Not Allowed');
      break;
  }

  function getDetailProduct($id=0)
  {
    $productModel = new DetailModel();
    $respuesta = array();
    $productModel->updateMetaDataProduct($id);
    $detail = $productModel->getDetailProduct($id);
    $comment = $productModel->getComment($id);
    $respuesta = $detail;
    $respuesta['comments'] = $comment;
    echo json_encode($respuesta);
  }

?>