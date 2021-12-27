<?php declare(strict_types=1);


namespace App\factory;

use App\Application;

class AppFactory
{
    public static function create()
    {
        $app = new Application();
        return $app;
    }
}
