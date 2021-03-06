# mosquito_DB

Plusieurs répertoires :

*  **legacy**

    Toutes les documents en lien avec la première version de la base. Ce sont tous les documents fournis par Roger (aucun n'a été modifié) ainsi que la pile Docker nécessaire à leur fonctionnement.

    Il contient lui même trois sous-répertoire :

    * Database_sql_20180923


        Un dump de la base originale au format **SQL** et une **capture d'écran** de la représentation graphique des tables.


    * Database_interface_20180923

        Les fichiers originaux de l'interface web en php 5.3. Les instructions sur les infos à modifier se trouvent dans un fichier readme.txt (fichier original).


    * Docker_stack

        **php 5.3** (le langage dans lequel est écrit l'interface originale), n'étant plus maintenu depuis 2018, il est nécessaire de reconstituer un environement virtuel  qui dispose des logiciels dans les versions qui vont bien.

        Ici, donc, une pile Docker ([https://docs.docker.com/engine/install/](URL)), pour lancer un environnement **Apache/mySQL/php5.3** de manière à visualiser l'interface. 
        Il faut :

            1. Lancer la pile Docker (fichier 'indonesia.sh' en ayant prit soin de modifier les chemins vers l'interface
            2. Dumper la base présente dans le répertoire (instruction dans le fichier 'Readme' de ce répertoire, notamment pour obtenir le mot de passe 'mysql'.
            3. modifier le fichier i_dbase.php' du répertoire 'Database_sql_20180923' avec le bon mot de passe mysql.
            
    C'est complexe, mais c'est là seule façon que j'ai trouvé pour pouvoir lire les fichiers originaux (et pour avoir recherché sur différents forum et poser la question sur des liste de diffusion métiers, il n'y a pas vraiment d'autres solutions).

* **2022-04_DB_scheme**

    Le projet de structure de la nouvelle base de données. Il s'agit d'un premier jet réalisé avec Roger. Il manque à ce jour les aspects 'SHS' ainsi que la/les tables pour l'intégration des documents multimédias (photos, vidéos, sons, etc). La structure est par ailleur sans doute très perfectible. 

    Elle est disponible sous trois formats : **sql** (ouvrable avec un éditeur texte) **dmb** (ouvrable avec pgmodeler - [https://pgmodeler.io/](URL) - outil de conception de base de données postGRES/postGIS) **png** (capture d'écran de la structure sous pgmodeler, ouvrable avec n'importe quelle visionneuse d'image).

* **2022-04-21_interface**

    Des essais d'interface sous Qt, ouvrables avec QT Designer par exemple (https://www.qt.io/). 

    Il faut les considérer comme moins qu'un premier jet, à peine comme un brouillon. D'ailleurs, personnellement, j'aurais préféré que l'on fasse cette étape **après avoir terminé la définition de la structure**. Et **d'abord sur papier**, en commençant par un schéma de succesion des formulaires de l'interface, avant même de réfléchir au design même de celle-ci (charue, boeufs, etc). La pratique n'est donc pas du tout académique, et doit être IMHO totalement repensée. 
    
