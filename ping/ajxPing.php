<?php

  // Data ajax from client (filtered)
  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $ipAddr = NULL;
  if (preg_match("/^.{0,100}$/", $data['ipAddr'])) $ipAddr = $data['ipAddr'];

  // Check
  if ($ipAddr == NULL) {
    $html = "<p><span>Format de l'adresse IP incorrecte</span></p>";
    echo json_encode(["success"=>false, "html"=>$html]);
    exit();
  }

  $pwd = shell_exec("pwd");
  $ping = "ping -c 4 " . $ipAddr;
  $html = "┌──(<span class='blue'>mike㉿timeMachine</span>)-[<span class='white'>/var/www/html/escape</span>]\n└─<span class='blue'>$</span> $ping\n";
  $html .= "<p>" . shell_exec($ping) . "</p>";

  echo json_encode(["success"=>true, "html"=>$html]);
  exit();

?>