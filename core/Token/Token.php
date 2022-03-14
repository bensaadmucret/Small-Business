<?php declare(strict_types=1);

namespace Core\Token;

use Core\Session\Session;

class Token
{
    private static $token = '';

    public static function generateToken(Session $session): string
    {
        $token = '';
        $token .= bin2hex(random_bytes(32));       
        $_SESSION['csrf_token'] = $token;
        self::$token = $token;
       
        return $token;
        
    }
    
    public static function getToken(): string
    {
        return self::$token;
    }
    
    
   
    public static function getTokenFromSession(): string
    {
        return $_SESSION['csrf_token'];
    }
    
    public static function isTokenValidInSession(string $token): bool
    {
        return $token === $_SESSION['csrf_token'];
    }
    
    public static function removeTokenFromSession(): void
    {
        unset($_SESSION['csrf_token']);
    }
    
    public static function removeTokenFromSessionIfExists(): void
    {
        if (isset($_SESSION['csrf_token'])) {
            unset($_SESSION['csrf_token']);
        }
    }
    
    

    public function __toString()
    {
        return self::generateToken();
    }
}