Moodle UCA - Export de notes pour Apogée (moodle-grade-export_apogee)
==================================
Plugin d'export de notes ayant pour but d'obtenir un fichier contenant les notes des étudiants et utilisables dans le logiciel Apogée.

Pré-requis
------------
- Moodle en version 3.3 (build 2017051500) ou plus récente.<br/>
-> Tests effectués sur des versions 3.3 à 3.6.3<br/>

Installation
------------
1. Installation du module

- Avec git:
> git clone https://github.com/andurif/moodle-grade-export_apogee.git grade/export/apogee

- Téléchargement:
> Télécharger le zip depuis https://github.com/andurif/moodle-grade-export_apogee/archive/master.zip, dézipper l'archive dans le dossier grade/export/ et renommer le si besoin le dossier en "apogee".
  
2. Aller sur la page de notifications pour finaliser l'installation du plugin.  
  
Description / Utilisation
------
<p>L'objectif de ce plugin est d'exporter un fichier contenant des notes d'étudiants pour un cours ou un élément de notation (test, devoir...) que l'on pourra importer dans 
le logiciel Apogée via SNW. Du fait que le logiciel Apogée nécessite un fichier formaté d'une manière bien précise et avec des informations pas forcément disponibles dans moodle,
nous avons choisi de travailler à partir d'un fichier déjà formaté que l'utilisateur aura exporté auparavant d'Apogée et avec la population d'étudiant à noter (voir ficher example.csv).<br/>
En résumé, le plugin parcourera ce fichier fourni par l'utilisateur et le complétera avec les notes des étudiants listés dans le fichier.</p> 
<p>Un formulaire est mis en place et demandera à l'utilisateur de fournir le fichier issu d'apogée "vide", de choisir pour quel élément notation récupérer les notes et au besoin le délimiteur utilisé dans le fichier.</p>
<p>Une étape sera éventuellement à effectuer pour faire fonctionner l'export. Il s'agit de définir au niveau du fichier <i>grade_export_apogee.php</i> une constante qui permettra d'indiquer où commence la liste des étudiants dans le fichier.
Lors du parcours du fichier, si cette constante est rencontré cela signifiera que les prochaines lignes correspondront aux étudiants et qu'il faudra donc rajouter les notes qu'ils ont obtenus.</p>

```php
<?php   
//Const variable used to define the start of the user list in the file. The use and the update of the file will start just after this line.
//It can be set to null if you do not want use delimiter and run every lines if the given file.
const STARTLIST_DELIMITER = 'XX_ETUDIANTS_XX';
```

<p>Note: pour faire le lien avec les utilisateurs en base de donnée, nous utilisons le champ <i>Numéro d'identification</i> où est renseigné pour tous le code étudiant que l'on pourra retrouver dans le fichier .csv.<br/>
En fonction de votre configuration, il faudra modifier la fonction <i>print_grades()</i> du même fichier pour pouvoir faire le lien sur un autre champ de la table mdl_user.</p>

To do / Améliorations possibles
------
* Ajouter une configuration au plugin (définitions des headers...).
* Utilisation du fichier dump.php ?
* Envisager de déposer que l'en-tête du fichier et le remplir avec tous les étudiants au cours ?
* Tests


A propos
------
<a href="https://www.uca.fr">Université Clermont Auvergne</a> - 2018
