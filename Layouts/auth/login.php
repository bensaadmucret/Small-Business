

<?php echo '<h3>' . $title ?? 'Connexion</h3>'; ?>
<?php echo '<h3>' . $message ?? ' Connexion </h3>'; ?>
<?php $error = $error ?? ''   ;

if($error) {
    echo '<div class="bg-red-500 text-gray-100 text-center ">'. $error . '</div>';
} ?>



<?php echo $form; ?>

