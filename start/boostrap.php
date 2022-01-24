<?php declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    define("ROOT", dirname($_SERVER['DOCUMENT_ROOT']));
}
if (!defined('APP_PATH')) {
    define("APP_PATH", ROOT . DS);
}


// absolute path for css, js, image
function assets($path)
{
    $httpRequest  = Request::createFromGlobals();
    $baseUrl = $httpRequest->server->get('HTTP_HOST');
    $baseUrl = 'http://'.$baseUrl;
    return $baseUrl . $path;
}
