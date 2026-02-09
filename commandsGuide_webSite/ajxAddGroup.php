<?php

  // DB open
  include_once("./cfgDb.php");
  $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
  $db->set_charset("utf8");


  // Data ajax from client (filtered)
  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $groupName = NULL;
  if (preg_match("/^.{0,100}$/", $data['groupName'])) $groupName = $data['groupName'];

  // Check
  if ($groupName == NULL) {
    $html = "Nom du group vide";
    echo json_encode(["success"=>false, "html"=>$html]);
    exit();
  }

  // DB insert
  $query = "INSERT INTO tblGroups (id, groupName, `start`, `end`) VALUES (NULL , '$groupName', NOW(), NULL);";
  $success = $db->query($query);

  // Check
  if (!$success) {
    $html = "Nom invalide";
    echo json_encode(["success"=>false, "html"=>$html]);
    exit();
  }
  $lastInsertedId = $db->insert_id;

  // Data to session
  session_start();
  $_SESSION['idGroup'] = $lastInsertedId;
  echo json_encode(["success"=>true]);
  exit();

  // DB close
  $db->close();

?>