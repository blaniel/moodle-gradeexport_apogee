Moodle UCA - Export de notes pour Apogée (moodle-gradeexport_apogee)
==================================
Plugin d'export de notes ayant pour but d'obtenir un fichier contenant les notes des étudiants et utilisables dans le logiciel Apogée.

Pré-requis
------------
- Moodle en version 3.3 (build 2017051500) ou plus récente.<br/>
-> Tests effectués sur des versions 3.3 à 3.11.0<br/>

Installation
------------
1. Installation du module

- Avec git:
> git clone https://github.com/andurif/moodle-gradeexport_apogee.git grade/export/apogee

- Téléchargement:
> Télécharger le zip depuis https://github.com/andurif/moodle-gradeexport_apogee/archive/refs/heads/master.zip, dézipper l'archive dans le dossier grade/export/ et renommer le si besoin le dossier en "apogee" ou installez-le depuis la page d'installation des plugins si vous possédeez les bons droits.
  
2. Aller sur la page de notifications pour finaliser l'installation du plugin.

3. Une fois installé, vous devriez pouvoir renseigner l'option d'administration:

> Administration du site -> Notes -> Réglages d'exportation -> Fichier pour Apogée -> startlist_delimiter

Cette option vous permet de définir un délimiteur qui indiquera le début de la liste des utilisateurs dans le fichier .csv importé. Lors du parcours du fichier, si cette chaîne est rencontrée cela signifiera que les prochaines lignes correspondront aux étudiants et qu'il faudra donc rajouter les notes qu'ils ont obtenus.
  
  
Description / Utilisation
------
<p>L'objectif de ce plugin est d'exporter un fichier contenant des notes d'étudiants pour un cours ou un élément de notation (test, devoir...) que l'on pourra importer dans 
le logiciel Apogée via SNW. Du fait que le logiciel Apogée nécessite un fichier formaté d'une manière bien précise et avec des informations pas forcément disponibles dans moodle,
nous avons choisi de travailler à partir d'un fichier déjà formaté que l'utilisateur aura exporté auparavant d'Apogée et avec la population d'étudiant à noter (voir ficher example.csv) et qu'il renseignera dans le module.<br/>
En résumé, le plugin parcourera ce fichier fourni par l'utilisateur et le complétera avec les notes des étudiants listés dans le fichier.</p> 
<p>Un formulaire est mis en place et demandera à l'utilisateur de fournir le fichier issu d'apogée "vide", de choisir pour quel élément notation récupérer les notes et au besoin le délimiteur utilisé dans le fichier.</p>
<p>Le système prendra en compte le délimiteur de début de liste défini dans l'administration et la configuration du plugin pour indiquer où commence la liste des étudiants dans le fichier.<br/>
Ce paramètre était directement intégré dans le code des versions précédentes du plugin mais a été ajouté comme paramètre  pour ajouter plus de fléxibilité.</p>

<p>Note: pour faire le lien avec les utilisateurs en base de donnée, nous utilisons le champ <i>Numéro d'identification</i> où est renseigné pour tous le code étudiant que l'on pourra retrouver dans le fichier .csv.<br/>
En fonction de votre configuration, il faudra, pour l'instant, modifier directement la fonction <i>print_grades()</i> du même fichier pour pouvoir faire le lien sur un autre champ de la table mdl_user ou depuis une autre colonne du fichier fourni.</p>

To do / Améliorations possibles
------
* Permettre de définir via l'interface les colonnes et valeurs à utiliser pour faire la correspondance (de manière similaire à la prévisualisation lors de l'importation de notes).
* Envisager de ne déposer que l'en-tête du fichier et le remplir avec tous les étudiants au cours ?
* Tests plus poussés


A propos
------
<a href="https://www.uca.fr">Université Clermont Auvergne</a> - 2020
