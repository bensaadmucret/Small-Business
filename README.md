# Small-Business

## Déscription du projet :  e-boutique sans framework
### Accès sur 3 points :

     * Performance : Juste le code qu'il faut
     * Simplicité :  une approche type Snipcart, solution e-commerce clef en main. Gestion de contenu (CMS)
     * Portabilité : peut être hébergé sur n’importe serveur web et peut donc être migré facilement selon les besoins.

### Helper
     * function assets(); donne le Chemin de fichier absolu à partir de la racine...
     ''' exemple <link rel="stylesheet" href="<?php echo assets('/assets/css/style.css'); ?>" />

### Router 
####  Le routeur se compose :  d'une méthodes HTTP (GET, POST, PUT et DELETE) L'URL à capturer, on pourra faire appel à un controller en mettant par ex : ProductController@index  qui fera appel à la class  ProductController et à la méthode index(), vous pouvez utiliser bien sûr une fonction anonyme en lui passant les paramètres... Ainsi que une nom de route.

> Par exemple : 

>
         $router->add('GET', '/product', 'ProductController@index', 'product_index'); 
         $router->add('GET', '/product/:id', 'ProductController@show', 'product_show'); 

### Le Controler
=================
La syntaxe est simple : on crée une classe qui hérite de BaseController. Notez que le nom de la classe, conformément au PSR-1 adopte le principe du StudlyCaps,  c’est à dire que chaque mot commence par une majuscule, y compris le premier (contrairement au camelCase).

>BaseController vous donne accès a la méthode render(), Afin de faire des vues des plus réutilisable et facile à entretenir. Vous avez accès a la mèthode redirect(), pour facilité vos redirection. Il donne accès aussi a la connexion a la base de donnée ainsi que a la class FormBuilder() pour la création de formulaire très inspirée du système de Form Builder de Symfony.