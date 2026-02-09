<?php

  // DB open
  include_once("./cfgDb.php");
  $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
  $db->set_charset("utf8");

  // Data from session
  session_start();
  $idGroup = NULL;
  $isOver = "false";
  if (isset($_SESSION['idGroup'])) $idGroup = $_SESSION['idGroup'];
  if (isset($_SESSION['isOver'])) $isOver = $_SESSION['isOver'];

  // Check
  if ($idGroup == NULL) {
    header("Location: logout.php");
    exit();
  } elseif ($isOver == "false") {
    header("Location: commands.php");
    exit();
  }

  // DB select
  $query = "SELECT id, groupName, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, start, end)) AS duration FROM tblGroups WHERE id = '$idGroup';";
  $result = $db->query($query);
  $numRows = $result->num_rows;

  // Check
  if ($numRows == 0) {
    header("Location: logout.php");
    exit();
  }

  // Data from DB
  while ($row = $result->fetch_assoc()) {
    $duration = $row['duration'];
  }
  $result->close();

  // DB select
  $query = "SELECT id, groupName, TIMESTAMPDIFF(SECOND, start, end) AS duration_seconds, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, start, end)) AS duration FROM tblGroups ORDER BY duration_seconds ASC;";
  $result = $db->query($query);
  $numRows = $result->num_rows;

  // Check
  if ($numRows == 0) {
    header("Location: logout.php");
    exit();
  }

  // Data from DB
  $scoreboard = "";
  $ranking = 0;
  while ($row = $result->fetch_assoc()) {
    $groupName = $row['groupName'];
    $time = $row['duration'];
    $id = $row['id'];
    if ($time != NULL) {
      $ranking += 1;
      $scoreboard .= "      <li>\n";
      if ($id == $idGroup) $scoreboard .= "        <p>$ranking. <span>$groupName</span></p>\n";
      else $scoreboard .= "        <p>$ranking. $groupName</p>\n";
      $scoreboard .= "        <p>$time</p>\n";
      $scoreboard .= "      </li>\n";
    }
  }
  $result->close();

  // DB close
  $db->close();

?>
<!DOCTYPE html>

<html>
  <!-- Head -->
  <head>
    <!-- CSS files -->
    <link rel='stylesheet' type='text/css' href='./css/web.css' media='screen' />
    <!-- <link rel='stylesheet' type='text/css' href='./css/00_reset.css' media='screen' /> -->
    <!-- <link rel='stylesheet' type='text/css' href='./css/01_mobile.css' media='screen' /> -->
    <link rel='stylesheet' type='text/css' href='./css/02_fonts.css' media='screen' />
    <link rel='stylesheet' type='text/css' href='./css/03_icons.css' media='screen' />

    <!-- JS files -->
    <script type='text/javascript' src='./js/jquery-3.7.0.min.js'></script>
    <!-- <script type='text/javascript' src='./js/jquery-ui.min.js'></script> -->
    <!-- <script type='text/javascript' src='./js/refresh1s.js'></script> -->
    <script type='text/javascript' src='./js/web.js'></script>
    <script type='text/javascript' src='./js/ajxAddGroup.js'></script>

    <!-- UTF8 encoding -->
    <meta charset='UTF-8'>

    <!-- Prevent from zooming -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no"> -->

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/iut.png' />

    <!-- Title -->
    <title>GameOver</title>
  </head>



  <!-- Body -->
  <body>
    <!-- Wrapper -->
    <div class='wrapper'>
    
    <br><h1>Votre temps est de : <?=$duration?></h1><br><br><br>

    <h1>Tableau de scores : </h1>

    <ul>
      <li class='title'>
        <p>Groups</p>
        <p>Temps</p>
      </li>
      <?=$scoreboard?>
    </ul><br>
      
    </div>
  </body>
</html>
