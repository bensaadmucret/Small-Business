<div class=" section mt-3">
<?php echo '<h3>' . $title ?? 'Connexion</h3>'; ?>
<?php echo '<h3>' . $message ?? ' Connexion </h3>'; ?>
<?php $error = $error ?? ''   ;

if($error) {
    echo '<div class="bg-red-500 text-gray-100 text-center ">'. $error . '</div>';
} ?>
</div>

<div class="section">
<div class="mt-3 border shadow rounded p-lg-10">
<?php echo $form; ?>
</div>
</div>