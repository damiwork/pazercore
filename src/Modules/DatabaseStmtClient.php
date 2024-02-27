<?php declare(strict_types=1);
namespace PazerCore\Modules;
use mysqli;
use PazerCore\Structs\DataSeatStmt;
class DatabaseStmtClient {
    protected ?mysqli $_client;
    public function __construct(mysqli $client) {
        $this->_client = $client;
        return $this;
    }
    public function query_select(string $query, array $data) : DataSeatStmt {
        $seat = new DataSeatStmt();
        $stmt = $this->_client->prepare($query);
        $types = '';
        foreach ($data as $item) { $types .= $this->determineType($item); }
        $stmt->bind_param($types, ...$data);
        $stmt->execute();
        $result = $stmt->get_result();
        $output = [];
        $seat->id = $stmt->id;
        while ($row = $result->fetch_assoc()) { $output['data'][] = $row; }
        $stmt->close();
        $seat->data = $output;
        return $seat;
    }
    public function query_insert(string $query, array $data) : DataSeatStmt {
        $seat = new DataSeatStmt();
        $stmt = $this->_client->prepare($query);
        $types = '';
        foreach ($data as $item) { $types .= $this->determineType($item); }
        $stmt->bind_param($types, ...$data);
        $stmt->execute();
        $seat->id = $stmt->id;
        $seat->rid = $stmt->insert_id;
        $stmt->close();
        return $seat;
    }
    public function query(string $query, array $data) : DataSeatStmt {
        $seat = new DataSeatStmt();
        $stmt = $this->_client->prepare($query);
        $types = '';
        foreach ($data as $item) { $types .= $this->determineType($item); }
        $stmt->bind_param($types, ...$data);
        $stmt->execute();
        $seat->id = $stmt->id;
        $seat->affected = $stmt->affected_rows;
        $stmt->close();
        return $seat;
    }
    protected function determineType($var) : string {
        if (is_int($var)) return 'i';
        if (is_double($var)) return 'd';
        if (is_string($var)) return 's';
        return 'b';
    }
}