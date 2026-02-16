# Retro-Pass
Présentation de notre escape game_Retro Pass et tutoriel pour le réaliser de A à Z.


À l'occasion de la JPO de l'IUT de Kourou 2026, nous avons réaliser un escape game digital utilisant multiples technologie et permettant ainsi aux participants d'avoir une première approche du département _Réseaux et Télécommunications_ tout en s'amusant. 

**Mise en contexte**


Vous incarnez le personnage du nom de _Mike_, un chercheur en voyage temporelle provenant de l'année 3125. Vous vous retrouver téléporté dans le passé : plus précisement en 1973 . À l'aide de _Miki_, votre partenaire de travail qui communiquera via une petite console, vous devrez résoudre des énigmes afin de vous connecter à votre machine à remonter dans le temps pour revenir à votre époque. 


L'escape game peut être joué en groupe de 4 joueurs maximum. La majorité des énigmes se feront sur un poste fonctionnant sur la distribution Debian 13. Les ou le participant(s) démarreront sur un poste (différent de celui citer précedemment) et devront choisir un nom d'équipe avant de commecner le jeu. Dès que le nom d'équipe sera entré, un chrono se lancera et les joueurs devront allumer le M5 Stack pour suivre le fil rouge de l'escape game.


## Guide - mettre en place Retro-pass chez vous

**Etape 1 : Mise en place du site principale**

Ce site permet aux joueur de s'enregistrer pour commencer l'escape game, il contien aussi toute les commandes utiles et une explication de leur fonctionnemnt

Tout d'abord il faudra sur votre machine installer le langague PHP ainsi q'un serveur web comme apache
1. On commence par mettre à jour le cache des paquets :
```
> sudo apt update
```

2. Ensuite, on installe le paquet apache2 afin d'obtenir la dernière version d'Apache 2.4.
```
> sudo apt install -y apache2
```

3. Pour qu'Apache démarre automatiquement au démarrage de la machine, saisissez la commande ci-dessous (même si normalement c'est déjà le cas) :
```
> sudo systemctl enable apache2
```

4. Tester si apache fonctionne

Pour tester cela il faut, dans un navigateur, écrire dans la barre de recherche `localhost`, cela devrais afficher la page de apache.

![image de la page apache une fois installé](/commandsGuide_webSite/medias/apache.png "page apache")

**Étape 3 : Technologies**
Dans les mini-jeux, nous utilison différentes technologies qu'il faudra aussi mettre en place. La première concerne le Snake,....................................................................................................

Viendra ensuite notre fameux personnage : Miki qui est en fait un simple script sur un M5stack. Nous avons utilisé un M5 Stack Fire et codé le script en micropython depuis le site web : https://uiflow2.m5stack.com/.
Dans le script du M5 Stack déposé, vous verrez que chacuns des dialogues de Miki sont en fait écrit dans un tableau de tableau. En effet, il était nous l'avons de cette manière car il fallait associé une expressions de Miki à chaque dialogue car elles varient. (Les différentes expréssions de Miki sont de le répertoire _Miki_Faces_)
Dans le script donné, ous aurez les ligne de dialogue de l'escape Game original, libre à vous au niveau de les modifier comme bon vous semble. 
Pour ce qui est des expréssions de Miki, afin de ne pas avoir trop de modifications à faire, il est recommandé de repecter le format suivant : une image png de taille 127x145 et sans fond. (Les expressions de base sont générées avec l'IA Chat GPT) 

Afin de faciliter les choses, il y a une fonction
