<?php declare(strict_types=1);
namespace PazerCore\Modules;
class ConfigManager {
    public bool $enableRun;
    public string $documentRoot;
    public function __construct() { return $this->reset(); }
    public function reset() : self {
        $this->enableRun = false;
        $this->documentRoot = "/";
        return $this;
    }
}