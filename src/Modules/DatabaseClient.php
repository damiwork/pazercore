<?php declare(strict_types=1);
namespace PazerCore\Modules;
use mysqli;
use mysqli_result;
use PazerCore\Structs\DatabaseConfig;
class DatabaseClient {
    protected DatabaseConfig $_config;
    protected ?mysqli $_client;
    protected ?DatabaseStmtClient $_stmt;
    public function __construct(DatabaseConfig $config) {
        $this->_config = $config;
        return $this->reset();
    }
    public function reset() : self {
        $this->_client = null;
        $this->_stmt = null;
        return $this;
    }
    public function connect() : self {
        $this->_client = new mysqli(
            $this->_config->hostname,
            $this->_config->username,
            $this->_config->password,
            $this->_config->database,
            $this->_config->port
        );
        if($this->_client->connect_error) {
            $this->reset();
        }else{
            $this->_client->set_charset($this->_config->charset);
            $this->_stmt = new DatabaseStmtClient($this->_client);
        }
        return $this;
    }
    public function close() : self {
        $this->_client->close();
        return $this->reset();
    }
    public function client() : mysqli { return $this->_client; }
    public function stmtClient() : DatabaseStmtClient { return $this->_stmt; }
    public function query(string $query) : mysqli_result { return $this->_client->query($query); }
}