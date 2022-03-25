<?php 

use Core\Flash\Flash;



echo 'Dashboard';

echo'<div class="bg-green-500 text-gray-100 text-center ">'. Flash::getMessage('success') . '</div>';
echo'<div class="bg-red-500 text-gray-100 text-center ">'. Flash::getMessage('error') . '</div>';


echo '<h3>' . $message ?? '' . '</h3>';









