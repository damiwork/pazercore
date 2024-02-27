<?php declare(strict_types=1);
namespace PazerCore\Structs;
class DataSeat {
    protected array $_data;
    protected DataSeatTime $_time;
    public function __construct() { return $this->reset(); }
    public function reset() : self {
        $this->_time = new DataSeatTime();
        $this->_data = array(
            "code" => 0,
            "status" => false
        );
        return $this;
    }
    public function setCode(int $code) : self { $this->_data['code'] = $code; return $this; }
    public function setStatus(bool $status) : self { $this->_data['status'] = $status; return $this; }
    public function setErrorCode(int $code) : self { $this->_data['error_code'] = $code; return $this; }
    public function setMessage(string $message) : self { $this->_data['message'] = $message; return $this; }
    public function setData($data) : self { $this->_data['data'] = $data; return $this; }
    public function times() : DataSeatTime { return $this->_time; }
    public function getDataArray(bool $enableRun = true) : array {
        $output = $this->_data;
        $this->_time->setEndTime();
        $output['time'] = $this->_time->getDataArray($enableRun);
        return $output;
    }
    public function getDataJSON(bool $enableRun = true) : string { return json_encode($this->getDataArray($enableRun),JSON_UNESCAPED_UNICODE); }
    public function show(bool $enableRun = true) : void { echo $this->getDataJSON($enableRun); }
}