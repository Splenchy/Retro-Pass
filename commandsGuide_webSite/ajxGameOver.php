<?php

  // Data from session
  session_start();
  $idGroup = NULL;
  if (isset($_SESSION['idGroup'])) $idGroup = $_SESSION['idGroup'];
  $isOver = "false";
  if (isset($_SESSION['isOver'])) $isOver = $_SESSION['isOver'];
  
  // Check
  if ($idGroup == NULL) {
    echo json_encode(["success"=>false, "logout"=>true]);
    exit();
  } elseif ($isOver == "true") {
    echo json_encode(["success"=>true]);
    exit();
  }

  $html = "Pas la bonne date XD";

  // DB open
  include_once("./cfgDb.php");
  $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
  $db->set_charset("utf8");


  // Data ajax from client (filtered)
  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $gameOver = NULL;
  if (preg_match("/^.{0,100}$/", $data['gameOver'])) $gameOver = $data['gameOver'];

  // Check
  if ($gameOver == NULL) {
    echo json_encode(["success"=>false, "html"=>"Entrez une date"]);
    exit();
  } elseif ($gameOver != "30/02/3125") {
    echo json_encode(["success"=>false, "html"=>$html]);
    exit();
  }

  // DB insert
  $query = "UPDATE tblGroups SET `end` = NOW() WHERE id = $idGroup;";
  $success = $db->query($query);

  // Check
  if (!$success) {
    $html = "date invalide";
    echo json_encode(["success"=>false, "html"=>$html]);
    exit();
  }
  $lastInsertedId = $db->insert_id;

  $_SESSION['isOver'] = "true";
  // Data to session
  echo json_encode(["success"=>true]);
  exit();

  // DB close
  $db->close();
?>