# Small-Business

## Déscription du projet :  e-boutique sans framework
### Accès sur 3 points :

     * Performance : Juste le code qu'il faut
     * Simplicité :  une approche type Snipcart, solution e-commerce clef en main. Gestion de contenu (CMS)
     * Portabilité : peut être hébergé sur n’importe serveur web et peut donc être migré facilement selon les besoins.

### Helper
     * function assets();
     ''' exemple <link rel="stylesheet" href="<?php echo assets('/assets/css/style.css'); ?>" />

### Router 
####  Le routeur se compose :  d'une méthodes HTTP (GET, POST, PUT et DELETE) L'URL à capturer, on pourra faire appel à un controller en mettant par ex : ProductController@index  qui fera appel à la class  ProductController et à la méthode index(), vous pouvez utiliser bien sûr une fonction anonyme en lui passant les paramètres...

> Par exemple : 

>
         $router->add('GET', '/product', 'ProductController@index', 'product_index'); 
         $router->add('GET', '/product/:id', 'ProductController@show', 'product_show'); 