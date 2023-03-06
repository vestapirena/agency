<?php

  header('Content-type: application/json; charset=utf-8');
  include_once '../models/LikeModel.php';
  $request_method=$_SERVER['REQUEST_METHOD'];

  switch($request_method)
  {
    case 'GET':
      // Like
      if(!empty($_GET['id']))
      {
        $id=intval($_GET['id']);
        setLike($id);
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

  function setLike($id=0)
  {
    $likeModel = new LikeModel();
    $res = $likeModel->setLike($id);
    echo json_encode($res);
  }

?>