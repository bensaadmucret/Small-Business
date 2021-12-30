<?php declare(strict_types=1);

namespace App\Controller;

use Core\Database\Connection;
use Core\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends BaseController
{
    public function __contruct()
    {
        parent::__construct();
    }
    public function login()
    {
        $request = Request::createFromGlobals();
        dump($request->get('email'));
        dump($request->get('password'));
        dump($request->isMethod('post'));
        if($request->isMethod('post')){
            $posts = $request->request->all();           
            $this->loginPost();   
         }
       
    
 
        $this->render('auth/login', [
            'title' => 'Login',
            'message' => 'Please login to access the admin area.',
            
          
           
        ]);
    }

    private function loginPost()
    {
        $request = Request::createFromGlobals();

       
            $email = $request->get('email');
            $password = $request->get('password');

            if($email == '' || $password == '') {
                $this->render('auth/login',
                    [
                        'title' => 'Login',
                        'message' => 'Please login to access the admin area.',
                        'error' => 'Please fill in all fields.',
                    ]);
              
            } else {
                try {
                    $db = Connection::get()->connect();
                } catch (\PDOException $e) {
                    echo $e->getMessage();
                }
                \dump($db);
                $query = $db->prepare('SELECT * FROM admins WHERE email = :email');
                dump($query);
                $query->execute([
                    'email' => $email,
                ]);

                $admin = $query->fetch();
                dump($admin);
                if($admin) {
                    if(password_verify($password, $admin['password'])) {
                        $_SESSION['admin'] = $admin;
                        $this->render('auth/dashboard', [
                            'title' => 'Dashboard',
                            'message' => 'Welcome back, ' . $admin['username'] . '!',
                        ]);
                    } else {
                        $this->render('auth/login');
                    }
                } else {
                    $this->render('auth/login');
                }
            }
        
    }
}