<?php

class Database
{
    private static $instance = null;
    private $connection;
    private string $host = 'localhost';
    private string $username = 'root';
    private string $password = '060894';
    private string $database = 'cdms';

    // Constructor được khai báo là private để ngăn việc tạo đối tượng từ bên ngoài

    private function __construct()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        // kiểm tra kết nối đến database
        if ($this->connection->connect_error) {
            die('Connect Error (' . $this->connection->connect_errno . ') ' . $this->connection->connect_error);
        }
    }

    // Sử dụng static để đảm bảo chỉ khởi tạo duy nhất một instance
    public static function getInstance(): ?Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    // Phương thức để lấy kết nối đến database
    public function getConnection(): mysqli
    {
        return $this->connection;
    }
}

// Sử dụng Database Singleton
$db1 = Database::getInstance();
$conn1 = $db1->getConnection();

$db2 = Database::getInstance();
$conn2 = $db2->getConnection();

if ($conn1 === $conn2) {
    echo "Both connections are the same.\n";
}