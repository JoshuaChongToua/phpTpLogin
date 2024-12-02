<?php
class Connection {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $db;

    private static $instance = null;

    public function __construct() {
        $this->host = 'localhost';
        $this->dbname = 'tpphp';
        $this->username = 'root';
        $this->password = 'root';
        try
        {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname='
                . $this->dbname . ';charset=utf8', $this->username, $this->password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    public function getDb() {
        return $this->db;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance->db;
    }

}