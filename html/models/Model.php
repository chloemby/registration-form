<?php


namespace Models;


abstract class Model
{
    private $allowedRows = [];
    private $tableName = '';
    private $connection = null;
    private $id = null;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function save()
    {
        $paramString = '';
        $params = [];
        if ($this->id) {
            foreach ($this->allowedRows as $row) {
                $paramString .= $row . ' = ?,';
                $params[] = $$row;
            }
            $query = "update $this->tableName set $paramString where id=$this->id";
            $stms = $this->connection->prepare($query);
            foreach ()
        } else {
            $rowsString = '';
            foreach ($this->allowedRows as $row) {
                $rowsString .= $row . ',';
            }
            foreach ($this->)
            $query = "insert into $this->tableName ($rowsString) set ()";
        }
    }
}