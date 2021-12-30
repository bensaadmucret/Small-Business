<?php 

echo '<h3>' . $title ?? 'Connexion</h3>';
echo '<h3>' . $message ?? ' Connexion </h3>';
echo '<div class="alert">'. $error . '</div>' ?? '';
echo '<div>';
echo 'Dashboard';