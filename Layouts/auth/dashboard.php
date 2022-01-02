<?php 



echo 'Dashboard';

echo '<h3>' . $message ?? '' . '</h3>';
echo '<h3>'. $session['username'] . '</h3>';
echo $url;

echo '<button><a class="text-gray-100" href="/logout">Deconnexion</a></button>';


