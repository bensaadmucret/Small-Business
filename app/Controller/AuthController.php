<?php declare(strict_types=1);

namespace App\Controller;

use Core\Session\Session;
use Core\Database\Connection;
use Core\FormBuilder\FormBuilder;
use Core\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends BaseController
{

    public function __contruct()
    {
        parent::__construct();
        $session = new Session();
       
      
        
    }
    public function login()
    {
        Session::start();
       
       
        if( Session::get_session('admin')) {        
            $redirection = new RedirectResponse('/dashboard', 302);
            return $redirection->send();
        }
        $request = Request::createFromGlobals();
        $form = $this->form();
        if($request->isMethod('post')){
                
            $email = $request->get('email');
            $password = $request->get('password');          
            $this->loginPost();   
         }
       
    
 
        $this->render('auth/login', 
        [
            'title' => 'Login',
            'message' => 'Please login to access the admin area.',
            'form' => $form->create(),          
        ], 'admin');
    }

    private function loginPost()
    {
        $request = Request::createFromGlobals();       
        $email = $request->get('email');
        $password = $request->get('password');
            $form = $this->form();

            if($email == '' || $password == '') {
                Session::set_session('error', 'identifiant invalide.');                     
                $this->render('auth/login', [
                    'title' => 'Login',
                    'message' => 'Please login to access the admin area.',
                    'error' => Session::get_flash('error'),
                    'form' => $form->create(),
                    'email' => $email,
                ], 'admin');
              
            } else {
                try {
                    $db = Connection::get()->connect();
                } catch (\PDOException $e) {
                    echo $e->getMessage();
                }
               
                $query = $db->prepare('SELECT * FROM admins WHERE email = :email');               
                $query->execute([
                    'email' => $email,
                ]);

                $admin = $query->fetch();
              
                if($admin) {
                    if(password_verify($password, $admin['password'])) {
                        Session::start();
                        $_SESSION['admin'] = $admin;
                        $redirection = new RedirectResponse('/dashboard', 302);
                        
                        
                    } else {
                       Session::set_session('error', 'identifiant invalide.');                     
                        $this->render('auth/login', [
                            'title' => 'Login',
                            'message' => 'Please login to access the admin area.',
                            'error' => Session::get_flash('error'),
                            'form' => $form->create(),
                            'email' => $email,
                        ], 'admin');
                    }
                } else {
                    Session::set_session('error', 'identifiant invalide.');
                        $this->render('auth/login', [
                        'title' => 'Login',
                        'message' => 'Please login to access the admin area.',
                        'error' => Session::get_flash('error'),
                        'form' => $form->create(),
                        'email' => $email,
                        ],'admin');
                }
            }
        
    }

    public function logout()
    {
        Session::start();
        Session::destroy_session('admin');
        $this->render('auth/login', [
            'title' => 'Login',
            'message' => 'You have been logged out.',
            'form' => $this->form()->create(),
        ],'admin');
    }

    public function dashboard()
    {
        Session::start();
        if(!Session::get_session('admin')) {
            $this->redirect('/login', 302);
        }else {
            $router = new \Core\Router\Router();
            $router->generateUri('/dashboard');
            $this->render('auth/dashboard', [
                'title' => 'Dashboard',
                'message' => 'Welcome to the dashboard.',
                'session' => Session::get_session('admin'),
                'url' => $router->generateUri('dashboard'),
            ], 'admin');
        }
        
        
    }

    private function form()
    { 
        $request = Request::createFromGlobals();       
        $email = $request->get('email');
        $form = new FormBuilder();
        $form->startForm('/login', 'POST');
        $form->addFor( 'Email', 'Votre email');
        $form->addEmail('email',  $email ?? '', ['label' => 'Email', 'required' => true, 'autofocus', 'placeholder' => 'exemple@domain.com']);
        $form->addFor( 'password', 'Mot de passe');
        $form->addPassword('password', 'password', ['label' => 'Password', 'required' => true]);
        $form->addBouton('Envoyer',  ['label' => 'Login', 'class' => 'btn']);
        $form->endForm();
        return $form;
    }

}