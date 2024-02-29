<?php declare(strict_types=1);
namespace PazerCore\Modules;
use PazerCore\Structs\DatabaseConfig;
class DatabaseManager {
    protected array $_config;
    public function __construct() { $this->_config = array(); return $this; }
    public function setClient(string $name, string $hostname, string $username, string $password, string $database, int $port = 3306, string $charset = "utf8mb4") : self {
        $server = new DatabaseConfig();
        $server->hostname = $hostname;
        $server->username = $username;
        $server->password = $password;
        $server->database = $database;
        $server->port = $port ?? 3306;
        $server->charset = $charset;
        $this->_config[$name] = $server;
        return $this;
    }
    public function setClientForm(string $name, DatabaseConfig $config) : self {
        $this->_config[$name] = $config;
        return $this;
    }
    public function getClient(string $name) : ?DatabaseClient { return new DatabaseClient($this->_config[$name]) ?? null; }
}