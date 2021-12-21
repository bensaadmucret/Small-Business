<?php declare(strict_types=1);


namespace Core\Database;

/**
 * Represent the Connection
 */
class Connection
{

    /**
     * Connection
     * @var type
     */
    private static $conn;

    /**
     * Connect to the database and return an instance of \PDO object
     * @return \PDO
     * @throws \Exception
     */
    public function connect()
    {

        // read parameters in the ini configuration file
        $params = parse_ini_file(__DIR__. DIRECTORY_SEPARATOR .'database.ini');
        if ($params === false) {
            throw new \Exception("Error reading database configuration file");
        }
    
        $conStr = sprintf(
            "mysql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            $params['host'],
            $params['port'],
            $params['dbname'],
            $params['username'],
            $params['password']
        );

        $pdo = new \PDO($conStr);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        

        return $pdo;
    }

    /**
     * return an instance of the Connection object
     * @return type
     */
    public static function get()
    {
        if (null === static::$conn) {
            static::$conn = new static();
        }

        return static::$conn;
    }

    public function __construct()
    {
    }
    public function __clone()
    {
    }
    public function __wakeup()
    {
    }
    public function close()
    {
        if (null !== static::$conn) {
            static::$conn = null;
        }
    }
}
