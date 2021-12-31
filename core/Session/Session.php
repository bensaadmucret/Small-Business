<?php declare(strict_types=1);

namespace Core\Session;

class Session
{
    public static function start(): void
    {
        if(isset($_SESSION)) {
            return;
        }else{
            session_start();
        }
        
    }

    public static function get_session(string $name)
    {
        if (!isset($_SESSION[$name])) {
            $_SESSION[$name] = [];
        }
        return $_SESSION[$name];
    }

    /**
     * Creation of a session variable
     *
     * @param string $name
     * @param [type] $data
     * @return void
     */
    public static function set_session(string $name, $data)
    {
        $_SESSION[$name] = $data;
    }

    public static function destroy_session(string $name)
    {
        unset($_SESSION[$name]);
    }
    
    public static function destroy_all_sessions()
    {
        $_SESSION = [];
    }
    
    public static function destroy_all_sessions_except(array $except)
    {
        foreach ($_SESSION as $key => $value) {
            if (!in_array($key, $except)) {
                unset($_SESSION[$key]);
            }
        }
    }

    public  static function get_flash(string $name)
    {
        if (!isset($_SESSION[$name])) {
            return null;
        }
        $flash = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $flash;
    }
 
  
}