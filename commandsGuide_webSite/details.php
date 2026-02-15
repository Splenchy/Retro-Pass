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

  // Data from client (filtered)
  $cmd = NULL;
  if (preg_match("/^.{0,100}$/", $_GET['cmd'])) $cmd = $_GET['cmd'];
  $def = NULL;
  if (preg_match("/^.{0,100}$/", $_GET['def'])) $def = $_GET['def'];
  
  // Check
  if ($cmd == NULL && $def == NULL) {
    header("Location: commands.php");
    exit();
  }

  $htmlCmd = "<span>$cmd</span>";
  $infos = "";
  $contentList = "";
  $htmlDescription = "";
  $htmlDescription = "La commande $htmlCmd permet d";

  if ($cmd == "cd") {
    $htmlDescription .= "e se déplacer d’un dossier à un autre dans le terminal. Le terminal affiche un texte de type : <span>escape@pcRT ~ %</span>, Avant le %, il est écrit l'endroit où vous vous situez. Le 'home', ou 'répertoire de base', est représenté par '~'. Exemple d'<span class='exemple'>emplacement</span> : <span>escape@pcRT </span><span class='exemple'>~/Documents/projet22/config </span><span>%</span>";

    $contentList .= "$htmlCmd Documents</p>\n";
    $contentList .= "          <p>Permet d'aller dans le répertoire Documents</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd Documents/iutDocument</p>\n";
    $contentList .= "          <p>Allez dans le répertoire iutDocument qui est lui même dans Documents</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd ..</p>\n";
    $contentList .= "          <p>Pour retouner en arrière dans les repertoire</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd</p>\n";
    $contentList .= "          <p>Revenir dans le répertoire de base ~/";
  } elseif ($cmd == "ls") {
    $htmlDescription .= "e lister les fichiers et dossiers à l'endroit où vous êtes. Il est possible de lister le contenu d'un dossier sans s'y déplacer en y ajoutant le nom du dossier";

    $contentList .= "$htmlCmd</p>\n";
    $contentList .= "          <p>Liste les fichiers à l'endroit où vous vous situez</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd Documents</p>\n";
    $contentList .= "          <p>Liste les fichiers qui sont dans le dossier Documents</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd <span class='exemple'>-a</span></p>\n";
    $contentList .= "          <p>Liste TOUS les fichiers à l'endroit où vous vous situez, dont les fichiers/dosiers cachés</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd <span class='exemple'>-l</span></p>\n";
    $contentList .= "          <p>Affiche aussi les droits de chaque fichier";
  } elseif ($cmd == "cat") {
    $htmlDescription .= "'afficher le contenu d'un fichiers dans le terminal.";

    $contentList .= "$htmlCmd hash.txt</p>\n";
    $contentList .= "          <p>Met le contenu du fichiers hash.txt dans le terminal</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd Compte-rendu.docx</p>\n";
    $contentList .= "          <p>Affiche le contenu du Compte-rendu.docx dans le terminal";
  } elseif ($cmd == "nano") {
    $htmlDescription .= "'ouvrir un fichier dans le terminal, et permet de l'éditer.";

    $contentList .= "$htmlCmd hash.txt</p>\n";
    $contentList .= "          <p>Ouvre le fichiers hash.txt dans le terminal pour en modifier le contenu</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd Compte-rendu.docx</p>\n";
    $contentList .= "          <p>Ouvre Compte-rendu.docx dans le terminal pour en modifier le contenu";
  } elseif ($cmd == "john") {
    $htmlDescription .= "e tester des mots de passe en essayant plein de possibilités automatiquement afin de casser un <span>hash*</span>. ";

    $contentList .= "$htmlCmd <span class='exemple'>--wordlist=rockyou.txt</span> hash.txt</p>\n";
    $contentList .= "          <p>Permet de cracker les hashs se trouvant dans le fichier hash.txt, (<span class='exemple'>--wordlist=rockyou.txt</span> est pour utiliser la liste de mots de passe rockyou.txt, qui recense les mots de passe les plus utilisés)</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd <span class='exemple'>--incremental --format=NT</span> hashe.txt</p>\n";
    $contentList .= "          <p>Permet de cracker les hashs se trouvant dans le fichier hash.txt, attaque par force brute (essai de mots de passe un par un)";
  } elseif ($cmd == "ping") {
    $htmlDescription .= "e tester si une machine ou un service est accessible sur le réseau et mesure le temps de réponse.";

    $contentList .= "$htmlCmd 8.8.8.8</p>\n";
    $contentList .= "          <p>Permet de tester si le DNS de Google est accessible.</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd 1.1.1.1 <span class='exemple'>-c</span> 4</p>\n";
    $contentList .= "          <p>Permet de tester si le DNS de Cloudflare est accessible en envoyant un nombre limité de 4 requêtes.";
  } elseif ($cmd == "ssh") {
    $htmlDescription .= "e se connecter à une machine à distance grâce à son adresse et au nom de l'utilisateur.";

    $contentList .= "$htmlCmd mike@1.2.3.4</p>\n";
    $contentList .= "          <p>Permet de se connecter à la machine dont l'adresse IP est 1.2.3.4 en tant que Mike.</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>$htmlCmd alice@5.6.7.8 <span class='exemple'>-p</span> 7500</p>\n";
    $contentList .= "          <p>Permet de se connecter à la machine dont l'adresse IP est 5.6.7.8 sur le port 7500 en tant que Alice. (22 étant le port de base)";
  } elseif ($def == "hash") {
    $htmlDescription = "Un hash est le résultat d’une fonction mathématique appelée fonction de hachage, qui prend une donnée en entrée (un mot de passe, un fichier, un message, etc.) et la transforme en une empreinte numérique de taille fixe, généralement représentée sous forme de caractères hexadécimaux. Cette transformation est à sens unique : à partir du hash, il est théoriquement impossible de retrouver la donnée d’origine. Une bonne fonction de hachage possède plusieurs propriétés essentielles : une modification minime de la donnée initiale produit un hash totalement différent (effet avalanche), deux données différentes ne doivent presque jamais produire le même hash (résistance aux collisions), et le calcul doit être rapide et déterministe (la même entrée donne toujours le même hash). Les hashes sont largement utilisés en informatique et en cybersécurité, notamment pour stocker les mots de passe de manière sécurisée, vérifier l’intégrité des fichiers, signer des données ou encore identifier de manière unique un contenu sans révéler son contenu réel.";

    $contentList .= "Incassabilité</p>\n";
    $contentList .= "          <p>deux chaînes de caractères ne peuvent pas donner le même hash</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>Déterminisme</p>\n";
    $contentList .= "          <p>une donnée donne toujours le même hash</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>Irréversiblement</p>\n";
    $contentList .= "          <p>à partir du hash, on ne peut pas revenir à la donnée de base.";
  } elseif ($def == "ipAddr") {
    $htmlDescription = "Une adresse IP (Internet Protocol) est un identifiant numérique unique attribué à un appareil connecté à un réseau utilisant le protocole Internet, qui permet de l’identifier et de localiser sa position logique sur le réseau afin d’assurer l’acheminement des données. Elle joue un rôle comparable à une adresse postale : chaque paquet de données envoyé sur le réseau contient l’adresse IP source et l’adresse IP de destination pour savoir d’où il vient et où il doit aller. Il existe deux versions principales : IPv4, composée de quatre nombres entre 0 et 255 séparés par des points (ex. 192.168.1.1), et IPv6, beaucoup plus longue, conçue pour pallier la pénurie d’adresses IPv4. Une adresse IP peut être publique ou privée, statique ou dynamique, et elle est essentielle au fonctionnement d’Internet, que ce soit pour la navigation web, les communications réseau, la configuration des serveurs ou la mise en place de mécanismes de sécurité et de routage.";

    $contentList .= "Fonctionnement</p>\n";
    $contentList .= "          <p>Composé de 4 chiffres de 0 à 255. Avec des points entre (ex. 192.168.1.1)</p>\n";
    $contentList .= "        </li>\n";
    $contentList .= "        <li>\n";
    $contentList .= "          <p>Masque de sous réseau</p>\n";
    $contentList .= "          <p>Un masque de sous réseau permet de rendre l'adresse plus précise. Il permet de definir un reseau en utilisant une parti de l'adress (ex. 192.168.1.1/16 ici le masque est 16 donc les réseau est 192.168)";
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
    <title>Details</title>
  </head>

  <body>
    <div class='wrapper'>
<?php

  if ($cmd != NULL) echo "      <h1>Fonctionnement de la commande $htmlCmd</h1>";
  else echo "      <h1>Définition et propriété</h1>";

?>

      <h3>Description : </h3>
      <p class="detail"><?=$htmlDescription?></p>
      
      <ul>
        <li class="title">
<?php

  if ($cmd != NULL) echo "          <p>Exemples d'utilisation</p>";
  else echo "          <p>propriété</p>";

?>
          <p>Explication</p>
        </li>
        <li>
          <p><?=$contentList?></p>
        </li>
      </ul>
    </div>
    <a href="commands.php"><span>< Retour à la page de commandes</span></a>
  </body>
</html>