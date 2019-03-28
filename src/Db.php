<?php
/**
 * Created by PhpStorm.
 * User: oza
 * Date: 26/03/19
 * Time: 00:15
 */

namespace OZA\Database;


use Exception;
use PDO;

class Db
{
    /**
     * @var string|string
     */
    private $driver;
    /**
     * @var string|string
     */
    private $host;
    /**
     * @var string|string
     */
    private $username;
    /**
     * @var string|string
     */
    private $password;
    /**
     * @var PDO
     */
    protected $pdo;
    /**
     * @var string
     */
    private $name;

    /**
     * Db constructor.
     * @param string $driver
     * @param string $host
     * @param string $name
     * @param string $username
     * @param string $password
     */
    public function __construct(string $driver, string $host, string $name, string $username, string $password)
    {
        $this->driver = $driver;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;

        $this->initPdo();
    }

    /**
     * @param string|null $file
     * @return Db
     * @throws Exception
     */
    public static function fromConfig()
    {
        $config = Config::get('db');
        $keys = array_keys($config);
        $requiredKeys = ['driver', 'host', 'name', 'username', 'password'];

        foreach ($requiredKeys as $key) {
            if (!in_array($key, $keys)) {
                throw  new Exception("Db Config must have theses keys : " . join(', ', $requiredKeys));
            }
        }

        $instance = new static(
            $config['driver'],
            $config['host'],
            $config['name'],
            $config['username'],
            $config['password']
        );

        return $instance;
    }


    private final function initPdo()
    {
        $dsn = $this->driver . ":host=" . $this->host . ";dbname=" . $this->name;
        $this->pdo = new PDO($dsn, $this->username, $this->password, $this->getOptions());
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];
    }


    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * Drop all tables in db
     */
    public function dropAllTables()
    {
        $this->getPdo()->query('SET FOREIGN_KEY_CHECKS = 0;');
        if ($result = $this->getPdo()->query("SHOW TABLES")) {
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $name = array_values($row)[0];
                $this->getPdo()->query('DROP TABLE IF EXISTS ' . $name);
            }
        }
        $this->getPdo()->query('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /**
     * Check if a table exists in the current database.
     *
     * @param string $table Table to search for.
     * @return bool TRUE if table exists, FALSE if no table found.
     */
    public function tableExists(string $table)
    {

        // Try a select statement against the table
        // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
        try {
            $result = $this->getPdo()->query("SELECT 1 FROM $table LIMIT 1");
        } catch (Exception $e) {
            // We got an exception == table not found
            return FALSE;
        }

        // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
        return $result !== FALSE;
    }
}