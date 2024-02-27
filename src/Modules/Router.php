<?php declare(strict_types=1);
namespace PazerCore\Modules;
use mysql_xdevapi\Executable;

class Router {
    protected ConfigManager $_config;
    public function __construct(ConfigManager $config) {
        $this->_config = $config;
        return $this->reset();
    }
    public function reset() : self {
        return $this;
    }

    public function sss(callable $a,array $datas) : self {
        $a();
        return $this;
    }

}