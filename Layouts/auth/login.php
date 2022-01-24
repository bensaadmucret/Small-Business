

                           
<div class="wrapper">
    <div class="item-form">
<?php echo '<h2>' . $title ?? 'Connexion</h2>'; ?>
<?php echo '<h3>' . $message ?? ' Connexion </h3>'; ?>
<?php $error = $error ?? ''   ;
if($error) {
    echo '<div class="bg-red-500 text-gray-100 text-center ">'. $error . '</div>';
    } ?>
 <div class="item-form"><?php echo $form; ?></div>
</div>
</div>






