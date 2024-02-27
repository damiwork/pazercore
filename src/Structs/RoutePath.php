<?php declare(strict_types=1);
namespace PazerCore\Structs;
class RoutePath {
    protected array $_path;
    public function __construct() { return $this->reset(); }
    public function reset() : self {
        $this->_path = array();
        return $this;
    }
}