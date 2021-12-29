<?php declare(strict_types=1);

namespace App\Controller;

use Core\Controller\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        $this->render('auth/login');
    }
}