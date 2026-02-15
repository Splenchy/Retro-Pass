<?php

  // Data from session
  session_start();
  $idGroup = NULL;
  if (isset($_SESSION['idGroup'])) $idGroup = $_SESSION['idGroup'];
  
  // Check
  if ($idGroup == NULL) {
    header("Location: logout.php");
    exit();
  }

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
    <script type='text/javascript' src='./js/ajxGameOver.js'></script>

    <!-- UTF8 encoding -->
    <meta charset='UTF-8'>

    <!-- Prevent from zooming -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no"> -->

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/Retro-Pass.png' />

    <!-- Title -->
    <title>Commandes</title>
  </head>



  <!-- Body -->
  <body>
    <header>
      <p>Pour finir l'escape game entrez ici la date de laquelle vous venez</p>
      <input type="text" placeholder="JJ/MM/AAAA" name="gameOver" autofocus>
      <button class="ok">OK</button>
      <span class='exemple'></span>
    </header>

    <!-- Wrapper -->
    <div class='wrapper'>
    
      <h1>Liste de toutes les commandes utiles</h1>
      <ul class="commands">
        <li class="title">
          <p>commande</p>
          <p>description</p>
        </li>
        <a href="details.php?cmd=cd">
          <li>
            <p>cd</p>
            <p>Se déplacer dans les répertoires</p>
          </li>
        </a>
        <a href="details.php?cmd=ls">
          <li>
            <p>ls</p>
            <p>Liste tous les fichiers/répertoires du répertoire</p>
          </li>
        </a>
        <a href="details.php?cmd=cat">
          <li>
            <p>cat</p>
            <p>Affiche le contenue d'un fichier</p>
          </li>
        </a>
        <a href="details.php?cmd=nano">
          <li>
            <p>nano</p>
            <p>Permet d'éditer un fichier dans le terminal</p>
          </li>
        </a>
        <a href="details.php?cmd=john">
          <li>
            <p>john</p>
            <p>Permet de casser le hash d'un mot de passe</p>
          </li>
        </a>
        <!-- <a href="details.php?cmd=binwalk">
          <li>
            <p>binwalk</p>
            <p>Permet de détecter et d'extraire un fichier caché dans une image</p>
          </li>
        </a> -->
        <a href="details.php?cmd=ping">
          <li>
            <p>ping</p>
            <p>Envoie une requête à une adresse et attends sa réponse</p>
          </li>
        </a>
        <a href="details.php?cmd=ssh">
          <li>
            <p>ssh</p>
            <p>Établit une connexion sécurisée avec une machine distante</p>
          </li>
        </a>
      </ul>

      <h1>Définition</h1>

      <ul class="commands">
        <li class='title'>
          <p>mot(s)</p>
          <p>description</p>
        </li>
        <a href="details.php?def=hash">
          <li>
            <p>hash</p>
            <p>Un hash est un résumé d'une chaine de caractères et permet plusieurs principes intéressants pour les mots de passe.</p>
          </li>
        </a>
        <a href="details.php?def=ipAddr">
          <li>
            <p>Adresse IP</p>
            <p>Permet d'identifier de façon unique une machine sur internet.</p>
          </li>
        </a>
      </ul><br>

    </div>
  </body>
</html>
