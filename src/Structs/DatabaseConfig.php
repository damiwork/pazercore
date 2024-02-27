<?php declare(strict_types=1);
namespace PazerCore\Structs;
class DatabaseConfig {
    public string $hostname;
    public string $username;
    public string $password;
    public string $database;
    public int $port;
    public string $charset;
    public function __construct() { return $this->reset(); }
    public function reset() : self {
        $this->hostname = "";
        $this->username = "";
        $this->password = "";
        $this->database = "";
        $this->port = 3306;
        $this->charset = "";
        return $this;
    }
}