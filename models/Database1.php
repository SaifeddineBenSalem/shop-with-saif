<?php
class Database {
    private static $instance = null;
    private $pdo;

    // Database credentials
    const DB_NAME = 'phpproject1';
    const DB_USER = 'root';
    const DB_PASS = 'hello';
    const DB_HOST = 'localhost';

    // Private constructor to prevent direct instantiation
    private function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME, 
                self::DB_USER, 
                self::DB_PASS
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
