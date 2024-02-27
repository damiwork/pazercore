<?php declare(strict_types=1);
namespace PazerCore\Modules;
class RouteManager{
    protected array $_route;
    protected ConfigManager $_config;
    public function __construct(ConfigManager $config) {
        $this->_config = $config;
        return $this->_route_init();
    }
    public function reset() : self {
        $this->_route = array();
        return $this;
    }
    protected function _route_init() : self {
        $this->reset();
        $path = $_SERVER['REDIRECT_URL'] ?? "/";
        $this->_route['path'] = $path;
        $route = explode("/",$path);
        $target = $route[sizeof($route)-1];
        $target_ex = explode("?",$target);
        $target = $target_ex[0];
        array_splice($route,sizeof($route)-1,1);
        $target_path = implode("/",$route);
        if($target_path === "") $target_path = "/";
        $this->_route['target_path'] = $target_path;
        $this->_route['target'] = $target;
        return $this;
    }
    public function routing() : void {
        if(isset($this->_route['map'][$this->_route['target_path']][$this->_route['target']])){
            $page = $this->_config->documentRoot."/".$this->_route['map'][$this->_route['target_path']][$this->_route['target']]['page'] ?? "";
            if(file_exists($page)) include_once $page;
            else echo "[503] None file";
        }elseif(isset($this->_route['map'][$this->_route['target_path']]['__ALL__'])){
            $page = $this->_config->documentRoot."/".$this->_route['map'][$this->_route['target_path']]['__ALL__']['page'];
            if(file_exists($page)) include_once $page;
            else echo "[503] None file";
        }else{
            $page = $this->_config->documentRoot."/".$this->_route['map']['__ERR__'][404]['page'] ?? "";
            if(file_exists($page)) include_once $page;
            else echo "404 Page not found.";
        }
    }
    public function getTarget() : string { return $this->_route['target']; }
    public function getTargetPath() : string { return $this->_route['target_path']; }
    public function insertRoute(string $name, string $path, string $target, string $target_page, bool $aster = false) : self {
        if($aster) $target = "__ALL__";
        $this->_route['map'][$path][$target] = array("name" => $name, "page" => $target_page);
        return $this;
    }
    public function errorPage(int $code, string $target_page) : self {
        $this->_route['map']['__ERR__'][$code] = array("page" => $target_page);
        return $this;
    }
    public function getRouteMapArray() : array { return $this->_route; }
    public function getRouteMapJSON() : string { return json_encode($this->getRouteMapArray(), JSON_UNESCAPED_UNICODE); }
}