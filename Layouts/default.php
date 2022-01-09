<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="<?php echo absolutePath('/assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Non !</title>
</head>
<body>
<div class="main">
    <div class="container">
     <?php echo  $content; ?>
    </div>
   <div class="sidenav">
    <a class="sidenav_item" href="<?php echo absolutePath('/'); ?>"><i class="fas fa-cloud" style="font-size:60px;color:lightblue;"></i></a>  
    <a class="sidenav_item" href="<?php echo absolutePath('/'); ?>">Home</a>   
    <a class="sidenav_item" href="<?php echo absolutePath('/about'); ?>">About</a>
    <a class="sidenav_item" href="<?php echo absolutePath('/blog'); ?>">Blog</a>
    <a class="sidenav_item" href="<?php echo absolutePath('/contact'); ?>">Contact</a>
    <button class="btn sidenav_item"> Promos !</button>   
    <button class="btn pannier sidenav_item"> Pannier </button> 
    
    </div>
   
</div>

</body>
</html>
