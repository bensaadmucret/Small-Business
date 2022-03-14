<?php

namespace Core\Auth;

use Core\Token\Token;
use Core\Session\Session;
use Core\FormBuilder\FormBuilder;
use Symfony\Component\HttpFoundation\Request;

class LoginFormAuthenticator 
{   
    
    /**
     * formulaire de connexion
     *
     * @return form
     */
    public static function form()
    { 
        $session = new Session();
        $token = Token::generateToken($session);
        
        \dump($token);
        $request = new Request;      
        $email = $request->get('email');
        $form = new FormBuilder();
        $form->startForm('/login', 'POST', 'login-form')
        ->addFor( 'Email', 'Votre email')
        ->addEmail('email',  $email ?? '', ['label' => 'Email', 'required' => true, 'autofocus', 'placeholder' => 'exemple@domain.com'])
        ->addFor( 'password', 'Mot de passe')
        ->addPassword('password', 'password', ['label' => 'Password', 'required' => true])
        ->addToken( $token)
        ->addBouton('Envoyer', ['class'=>'btn-primary btn mb-3 mt-3 form-button wow fadeInUp animated'])
        ->endForm();
        return $form;
    }
}