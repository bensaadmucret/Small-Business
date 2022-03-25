<?php use Core\Flash\Flash; ?>

                           
<div class="wrapper">
    <div class="item-form">
<?php echo '<h2>' . $title ?? 'Connexion</h2>';
echo '<h3>' . $message ?? ' Connexion </h3>';

    echo'<div class="bg-red-500 text-gray-100 text-center ">'. Flash::getMessage('error') . '</div>';
?>
    

 <div class="item-form"><?php echo $form; ?></div>



 
</div>
</div>






