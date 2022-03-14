<?php

declare(strict_types=1);


namespace App\Controller;


use Core\Flash\Flash;
use Core\Controller\BaseController;
use Core\Auth\LoginFormAuthenticator as Authenticator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Core\Token\Token;


class AuthController extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        
    }


    /**
     * Authenticate a user with the given credentials.
     *
     * @param Request $request
     * @return bool
     */
    public function login()
    {
        if($this->session->get('admin')) {        
            //$redirection = new RedirectResponse('/security/dashboard', 302);
            //return $redirection->send();
            return $this->redirect('dashboard', 302);
        }

        if($this->request->isMethod('post')){  
            $email = $this->request->get('email');
            $password = $this->request->get('password');
            $user = $this->getUserDB($email, $password);
           
            $this->loginPost($user);   
         }

         
        $this->render('auth/login',
        [
            'title' => 'Login',
            'message' => 'Please login to access the admin area.',
            'form' => Authenticator::form(),          
        ], 'admin-login');
        
    }

    public function loginPost($user)
    {  
         
           
       $token = $this->request->get('token');
      
      if(Token::isTokenValidInSession( $token, $this->session)) {
               // dd('ok');
      } 
        
        if(!$user) {
            $this->flash->setMessage('error', 'Invalid credentials.');
            return $this->redirect('login', 302);
        }
        
   
        $email = $request->get('email');
        $password = $request->get('password');        
  

        if($email == '' || $password == '') {
            Flash::setMessage('error', 'identifiant invalide.');
            return false;
        }

        if($user) {
                if($this->isAdmin()){
                    $this->session->set('admin', $user);
                //$redirection = new RedirectResponse('/security/dashboard', 302);
                //return $redirection->send();
                echo 'je suis dnas le dashboard admin';
                echo $this->session->get('admin');
                }
        }else{
            $this->session->set('user', $user);
                //$redirection = new RedirectResponse('dashboard', 302); 
                //return $redirection->send();
                echo 'je suis dans le dashboard user';
                echo $this->session->get('user');
            }
        Flash::setMessage('error', 'identifiant invalide.');
        return false;  
  
        Authenticator::form();
       

    }
    
    /**
     * chek if user is authenticated and admin
     *
     * @return boolean
     */
    public static function isAdmin()
    {
        if(!isset($_SESSION['user'])) {
            return false;
        }
        
        $user = $_SESSION['user'];
        if($user['role'] == 'admin') {
            return true;
        }
        
        return false;
    }
    
    /**
     * logout user
     *
     * @return void
     */
    public function logout()
    {
        if($this->isAdmin()) {
            $session = $this->session;
            dump($session);
            $session->remove('user');
            
            $redirection = new RedirectResponse('/login', 302);
            return $redirection->send();
        }
        unset($_SESSION['user']);
    }
    

    /**
     * get user in session
     * @return array
     */
    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }


    /**
     * @return user in session
     */
    public function getUser()
    {
        return $_SESSION['user'];
    }

    /**
     * get user in database
     *
     * @param [type] $email
     * @param [type] $password
     * @return void
     */
    public function getUserDB($email, $password)
    {
        $db =  $this->connection;            
        $query = $db->prepare('SELECT * FROM users WHERE email = :email');               
        $query->execute([
            'email' => $email,
        ]);

        $user = $query->fetch();

        if($user) {
            if(password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
       
    }

    public function dashboard()
    {
        $this->render('auth/admin-dashboard',
        [
             'session' => $this->session->get('admin'),
            'title' => 'Dashboard',
            'message' => 'Welcome to your dashboard.',
        ], 'admin');
    }
    
}