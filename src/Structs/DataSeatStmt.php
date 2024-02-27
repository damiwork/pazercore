<?php declare(strict_types=1);
namespace PazerCore\Structs;
class DataSeatStmt {
    public bool $status;
    public array $data;
    public int $affected;
    public string $id;
    public string $rid;
    public function __construct() { return $this->reset(); }
    public function reset() : self {
        $this->status = false;
        $this->data = array();
        $this->id = "";
        $this->rid = "";
        $this->affected = 0;
        return $this;
    }
    public function getDataArray() : array {
        return array(
            "status" => $this->status,
            "affected" => $this->affected,
            "id" => $this->id,
            "rid" => $this->rid,
            "data" => $this->data
        );
    }
    public function getDataJSON() : string { return json_encode($this->getDataArray(),JSON_UNESCAPED_UNICODE); }
}