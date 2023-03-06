<?php

  header('Content-type: application/json; charset=utf-8');
  include_once '../models/ProductModel.php';
  include_once '../models/CategoryModel.php';
  $request_method=$_SERVER['REQUEST_METHOD'];

  switch($request_method)
  {
    case 'GET':
      // Retrive Products By Sub Id
      if(!empty($_GET['id']))
      {
        $id=intval($_GET['id']);
        getProducBySubCategory($id);
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

  function getProducBySubCategory($id=0)
  {
    $response = array();
    $productModel = new ProductModel();
    $productsByCategory = $productModel->getProducBySubCategory($id);
    echo json_encode($productsByCategory);
  }

  function getMethodPost()
  {
    $data = json_decode(file_get_contents('php://input'), true);
    $type=$data['type'];
    switch($type)
    {
      case 'random':
        // Retrive Random Products
        getRandomProducts();
        break;
      default:
        // Invalid Request Method
        header('HTTP/1.0 405 Method Not Allowed 1');
        break;
    }
  }

  function getRandomProducts()
  {
    $productModel = new ProductModel();
    $randomProducts = $productModel->getRandomProducts();
    echo json_encode($randomProducts);
  }

?>