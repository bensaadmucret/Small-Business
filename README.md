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
####  Le routeur se compose de la méthode, du patch, du controler ainsi que du nom de la route
     ``  $router->add('GET', '/product', 'ProductController@index', 'product_index'); 
          $router->add('GET', '/product/:id', 'ProductController@show', 'product_show');  ``