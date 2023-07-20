<?php

/**
 * SQLGetterSetter
 * To use this trait you need to define the following variables in the class
 * 1. $table => table name
 * 2. $conn => connection object
 * 3. $id => id of the row
 */
trait SQLGetterSetter
{
    public function __call($name, $arguments)
    {
        $securestring = strtolower(preg_replace("/\B([A-Z])/", "_$1", preg_replace("/[^0-9a-zA-z]/", "", substr($name, 3))));
        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($securestring);
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data_($securestring, $arguments[0]);
        } else {
            throw new Exception("posts::__call() -> $name, function not available");
        }
    }
    private function _get_data($var)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $dataQuery = "SELECT `$var` FROM `$this->table` WHERE `id` = $this->id";
        $result = $this->conn->query($dataQuery);
        if ($result and $result->num_rows) {
            $value = $result->fetch_assoc()["$var"];
            return $value;
        } else {
            return null;
        }
    }
    private function _set_data_($var, $data)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $dataQuery = "UPDATE `$this->table` SET `$var` = '$data' WHERE `id` = $this->id";
        //print($dataQuery);
        $result = $this->conn->query($dataQuery);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
