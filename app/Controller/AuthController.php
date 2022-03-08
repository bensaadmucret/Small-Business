<?php declare(strict_types=1);

namespace App\Controller;

use Core\Flash\Flash;
use Core\Router\Router;
use Core\Session\Session;
use Core\Database\Connection;
use Core\FormBuilder\FormBuilder;
use Core\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends BaseController
{
    public $session;

    public function __contruct()
    {
        
        $this->session = new Session();
        $this->session->start();
       
        
       
      
        
    }
    public function login()
    {
      
       $session = new Session();
         $session->start();
       
        if( $session->get('admin')) {        
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
        ], 'admin-login');
    }

    private function loginPost()
    {
        $session = new Session();
        $request = Request::createFromGlobals();       
        $email = $request->get('email');
        $password = $request->get('password');
        $form = $this->form();

            if($email == '' || $password == '') {
                $this->session->set('error', 'identifiant invalide.');                     
                $this->render('auth/login', [
                    'title' => 'Login',
                    'message' => 'Please login to access the admin area.',
                    'error' => Flash::getMessage('error'),
                    'form' => $form->create(),
                    'email' => $email,
                ], 'admin-login');
              
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
                        $this->session->start();
                        $_SESSION['admin'] = $admin;
                        $redirection = new RedirectResponse('/dashboard', 302);
                        return $redirection->send();
                        
                        
                    } else {
                       $session->set('error', 'identifiant invalide.');                     
                        $this->render('auth/login', [
                            'title' => 'Login',
                            'message' => 'Please login to access the admin area.',
                            'error' => Flash::getMessage('error'),
                            'form' => $form->create(),
                            'email' => $email,
                        ], 'admin-login');
                    }
                } else {
                    $session->set('error', 'identifiant invalide.');
                        $this->render('auth/login', [
                        'title' => 'Login',
                        'message' => 'Please login to access the admin area.',
                        'error' => Flash::getMessage('error'),
                        'form' => $form->create(),
                        'email' => $email,
                        ],'admin-login');
                }
            }
        
    }

    public function logout()
    {
        $this->session->start();
        $this->session->remove('admin');
        $this->render('auth/login', [
            'title' => 'Login',
            'message' => 'You have been logged out.',
            'form' => $this->form()->create(),
        ],'admin-login');
    }

    public function dashboard()
    {
        $session = new Session();
        $session->start();
        if(!$session->get('admin')) {
            $this->redirect('/login', 302);
        }else {
            $router = new Router();
          
            $this->render('auth/dashboard', [
                'title' => 'Dashboard',
                'message' => 'Welcome to the dashboard.',
                'session' => $this->session->get('admin'),
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