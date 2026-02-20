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

**Partie graphique (frontend)**

Dans le script du M5 Stack déposé, vous verrez que chacuns des dialogues de Miki sont en fait écrit dans un tableau de tableau. En effet, il était nous l'avons de cette manière car il fallait associé une expressions de Miki à chaque dialogue car elles varient. (Les différentes expréssions de Miki sont de le répertoire _Miki_Faces_)
Dans le script donné, ous aurez les ligne de dialogue de l'escape Game original, libre à vous au niveau de les modifier comme bon vous semble. 
Pour ce qui est des expréssions de Miki, afin de ne pas avoir trop de modifications à faire, il est recommandé de repecter le format suivant : une image png de taille 127x145 et sans fond. (Les expressions de base sont générées avec l'IA Chat GPT) 

Pour rendre plus agréable le terminal de _Miki_, nous avons ajouter de la couleur, il y a du rose et du bleu. Ces 2 couleurs sont en fait des rectangle colorés, chacuns prennant toute la largeur de l'écran et la hauteur que nous voulions. Pour cela nous avons utilisé la fonction lcd.SJQKSJQKSJQ() dans laquelle nous spécifions la longueur, la hauteur et la couleur de la forme.

Afin que chacune des expressions de _Miki_ s'affichent correctement, nous utilison une fonction clear_face_area(). Cette fonction a pour but de simplement effacer ce qu'il y a d'affiché dans la zone reservé à l'affichage de l'expression de _Miki_. Nous avons fais la quasi même fonction pour la zone de dialogue : clear_text_area().

**Programmation interne (backend)**

Sur le M5Stack, le bouton de droit (boutonC) permet d'aller au dialogue suivant et le bouton de gauche permet d'aller aua dialogue précédent. 
Afin de faciliter les choses, il y a une fonction forward() pour avancer de dialogue et une autre, backward() , pour aller au dialogue d'avant. Chacunes des fonctions est lancé en fonction du bouton qu'aura pressé le joueur.

Il y aussi une fonction gameOver() qui se lance lorsque que le joueur n'as plus de coeur. En effet, pour s'assurer qu'il est sur la bonne voie, _Miki_ demandera au joueur de dire parmis 3 propositions, qu'elle est l'indice qu'il a trouvé. À ces moments, 3 coeurs s'afficheront en haut à droite de l'écran, indiquant le nombre d'erreurs restant. À chaque mauvaise réponse, il perdra un coeur et s'il arrive à 0, un dialogue spécial se lance et une petite mélodie de défaite se joue. Voilà en quoi consiste la fonction gameOver().

Il y a ensuite une boucle principale (_while_) dans laquel tout ces éléments sont imbriqués.


