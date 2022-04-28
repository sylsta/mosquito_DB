# mosquitoe_DB

Plusieurs répertoires :

  *  legacy

    Toutes les documents en lien avec la première version de la base. Ce sont tous les documents fournis par Roger (aucun n'a été modifié) ainsi que la pile Docker nécessaire à leur fonctionnement.

    Il contient lui même trois sous-répertoire :

    * Database_sql_20180923
    
        Un dump de la base originale au format SQL.
    
    * Database_interface_20180923

        Les fichiers originaux de l'interface web en php 5.3. Les instructions sur les infos à modifier se trouvent dans un fichier readme.txt (fichier original)



    * Docker_stack
    
        php 5.3 (le langage dans lequel est écrit l'interface originale), n'étant plus maintenu depuis 2018, il est nécessaire de reconstituer un environement virtuel  qui dispose des logiciels dans les versions qui vont bien.

        Ici, donc, une pile Docker (https://docs.docker.com/engine/install/), pour lancer un environnement Apache/mySQL/php5.3 de manière à visualiser l'interface. 
        Il faut :

            1. Lancer la pile Docker (fichier 'indonesia.sh' en ayant prit soin de modifier les chemins vers l'interface
            2. Dumper la base présente dans le répertoire (instruction dans le fichier 'Readme' de ce répertoire, notamment pour obtenir le mot de passe 'mysql'
            3. modifier le fichier i_dbase.php' du répertoire 'Database_sql_20180923' avec le bon mot de passe mysql

       