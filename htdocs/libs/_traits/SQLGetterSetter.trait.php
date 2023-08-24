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
            throw new Exception(__CLASS__ . "::__call() -> $name, function not available");
        }
    }
    private function _get_data($var)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        try {
            $dataQuery = "SELECT `$var` FROM `$this->table` WHERE `id` = $this->id";
            $result = $this->conn->query($dataQuery);
            if ($result->num_rows) {
                $value = $result->fetch_assoc()["$var"];
                return $value;
            } else {
                return "No Data Found";
            }
        } catch (Exception $e) {
            throw new Exception(__CLASS__ . "::_get_data() -> $e");
        }
    }
    private function _set_data_($var, $data)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        try {
            $dataQuery = "UPDATE `$this->table` SET `$var` = '$data' WHERE `id` = $this->id";
            $result = $this->conn->query($dataQuery);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception(__CLASS__ . "::_set_data_() -> $e");
        }
    }

    public function delete()
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        try {
            // Delete the image from the server before deleting the post
            $imageUri = $this->getImageUri();
            $imageUri = substr($imageUri, 7);
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/../photogram_uploads/" . $imageUri;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            // Delete the post from the database
            $dataQuery = "DELETE FROM `$this->table` WHERE `id` = $this->id";
            $result = $this->conn->query($dataQuery);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception(__CLASS__ . "::_set_data_() -> $e");
        }
    }
}
