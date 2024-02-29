<?php declare(strict_types=1);
namespace PazerCore;
use PazerCore\Modules\ApiManager;
use PazerCore\Modules\ConfigManager;
use PazerCore\Modules\DatabaseManager;
use PazerCore\Modules\RouteManager;
class PazerCore {
    protected DatabaseManager $_dbms;
    protected ConfigManager $_config;
    protected ApiManager $_api;
    protected RouteManager $_route;
    public function __construct() {
        $this->_config = new ConfigManager();
        $this->_dbms = new DatabaseManager();
        $this->_api = new ApiManager($this->_config);
        $this->_route = new RouteManager($this->_config);
        return $this;
    }
    public function config() : ConfigManager { return $this->_config; }
    public function dbms() : DatabaseManager { return $this->_dbms; }
    public function api() : ApiManager { return $this->_api; }
    public function route() : RouteManager { return $this->_route; }
}