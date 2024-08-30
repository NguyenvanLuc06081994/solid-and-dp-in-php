<?php

class DatabaseConnection
{
    private string $host;
    private string $username;
    private string $password;
    private string $database;
    private string $port;
    private string $socket;
    private mysqli $connection;

    public function __construct(string $host, string $username, string $password, string $database, string $port, $socket)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
        $this->socket = $socket;
        $this->connection = new mysqli($host, $username, $password, $database, $port, $socket);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function closeConnection()
    {
        $this->connection->close();
    }
}

class DatabasePool
{
    private array $connections = [];
    private int $maxConnections = 10;

    public function getConnection()
    {
        if (count($this->connections) < $this->maxConnections) {
            $connection = new DatabaseConnection('localhost', 'root', 'root', 'test', '3306', '');
            $this->connections[] = $connection;

            return $connection;
        }

        return array_pop($this->connections);
    }

    public function releaseConnection($connection)
    {
        $this->connections[] = $connection;
    }
}

$pool = new DatabasePool();
$connection1 = $pool->getConnection();

$pool->releaseConnection($connection1);