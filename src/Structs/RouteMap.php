<?php declare(strict_types=1);
namespace PazerCore\Structs;
class RouteMap {
    protected array $_map;
    public function __construct() { return $this->reset(); }
    public function reset() : self {
        $this->_map = array();
        return $this;
    }
}