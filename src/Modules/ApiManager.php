<?php declare(strict_types=1);
namespace PazerCore\Modules;
use PazerCore\Structs\DataSeat;
class ApiManager {
    protected DataSeat $_data;
    protected ConfigManager $_config;
    protected float $time;
    public function __construct(ConfigManager $config) {
        $this->_config = $config;
        $this->time = microtime(true);
        $this->_data = new DataSeat();
        $this->_data->times()->setStartTimeValue($this->time);
        return $this;
    }
    public function setCode(int $code) : self { $this->_data->setCode($code); return $this; }
    public function setMessage(string $message) : self { $this->_data->setMessage($message); return $this; }
    public function setStatus(bool $code) : self { $this->_data->setStatus($code); return $this; }
    public function setErrorCode(int $code) : self { $this->_data->setErrorCode($code); return $this; }
    public function setData($data) : self { $this->_data->setData($data); return $this; }
    public function show() : void { $this->_data->show($this->_config->enableRun); exit(); }
    public function setHeaderJSON() : self { header('Content-Type: application/json; charset=utf-8'); return $this; }
    public function setResponseCode(int $code) : self { http_response_code($code); return $this; }
    public function getErrorShow(int $code, int $response_code, int $errorCode, string $message) : void {
        $err = new DataSeat();
        $this->setHeaderJSON()->setResponseCode($response_code);
        $err->times()->setStartTimeValue($this->time);
        $err->setCode($code)->setErrorCode($errorCode)->setMessage($message)->show($this->_config->enableRun);
        exit();
    }
    public function onlyGetMode(string $message = "only GET", int $code = 9999) : void {
        if($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->getErrorShow(403,403, $code,$message);
        }
    }
    public function onlyPostMode(string $message = "only POST", int $code = 9998) : void {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->getErrorShow(403,403, $code,$message);
        }
    }
}