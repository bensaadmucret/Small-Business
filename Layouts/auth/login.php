<?php echo '<h3>' . $title ?? 'Connexion</h3>'; ?>
<?php echo '<h3>' . $message ?? ' Connexion </h3>'; ?>
<?php $error = $error ?? ''   ;

if($error) {
    echo '<div class="alert">'. $error . '</div>';
}
echo $form; ?>