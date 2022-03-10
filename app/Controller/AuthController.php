<?php declare(strict_types=1);

namespace App\Controller;

use Core\Flash\Flash;
use Core\Controller\BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends BaseController
{
    

    public function __construct()
    {
        parent::__construct();
      
    }



    public function login()
    {
      $this->session;
           
        if( $this->session->get('admin')) {        
            $redirection = new RedirectResponse('/dashboard', 302);
            return $redirection->send();
        }
       
        $request = $this->request;
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
        $session = $this->session;
        $request = $this->request;
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
                $db =  $this->connection;               
               
                $query = $db->prepare('SELECT * FROM users WHERE email = :email');               
                $query->execute([
                    'email' => $email,
                ]);

                $admin = $query->fetch();
              
                if($admin) {
                    if(password_verify($password, $admin['password'])) {
                        $session->set('admin', $admin);
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
    {   $session = $this->session;
        $session->remove('admin');
        $this->render('auth/login', [
            'title' => 'Login',
            'message' => 'You have been logged out.',
            'form' => $this->form()->create(),
        ],'admin-login');
    }

    public function dashboard()
    {
        $session = $this->session;
        
        if(!$session->get('admin')) {
            $this->redirect('/login', 302);
        }else {
                      
            $this->render('auth/dashboard', [
                'title' => 'Dashboard',
                'message' => 'Welcome to the dashboard.',
                'session' => $session->get('admin'),
            ], 'admin');
        }
        
    }

    private function form()
    { 
        $request = $this->request;       
        $email = $request->get('email');
        $form = $this->formBuilder;
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