<?php declare(strict_types=1);
namespace PazerCore\Structs;
class DataSeatTime {
    public array $_time;
    public function __construct() { return $this->reset(); }
    public function reset() : self {
        $this->_time['start'] = 0;
        $this->_time['end'] = 0;
        $this->_time['run'] = 0;
        return $this;
    }
    public function setStartTime() : self { return $this->setStartTimeValue(microtime(true)); }
    public function setStartTimeValue(float $time) : self {
        $this->_time['start'] = $time;
        return $this;
    }
    public function setEndTime() : self { return $this->setEndTimeValue(microtime(true)); }
    public function setEndTimeValue(float $time) : self {
        $this->_time['end'] = $time;
        $this->_time['run'] = (float)$this->_time['end'] - (float)$this->_time['start'];
        return $this;
    }
    public function getDataArray(bool $enableRun = true) : array {
        $output = array(
            "start" => (float)$this->_time['start']
        );
        if($enableRun) {
            $output['end'] = (float)$this->_time['end'];
            $output['run'] = (float)$this->_time['run'];
        }
        return $output;
    }
    public function getDataJSON(bool $enableRun = true) : string { return json_encode($this->getDataArray($enableRun),JSON_UNESCAPED_UNICODE); }
}