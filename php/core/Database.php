<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/3/15
 * Time: 10:28 PM
 */

class Database
{
    private $servername = 'localhost';
    private $database = 'jeonline';
    private $username = 'root';
    private $password = '07010020';

    private $conn;

    /**
     * connect database
     * @return bool
     */
    public function connect(){
        try {
            // Create connection
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

            // Check connection
            if ($conn->connect_error) {
                error_log("Connection failed: " . $conn->connect_error, 0);
                return false;
            }

        }catch (Exception $e) {
            error_log("Exception: " . $e->getMessage(), 0);
        }

        $this->conn = $conn;
    }

    /**
     * select data
     * @param $sql
     * @return array
     */
    public function select($sql) {
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                 };
                return $rows;
            } else {
                return null;
            }
        }catch (\Exception $e) {
            error_log("Exception: " . $e->getMessage(), 0);
        }
    }

    /**
     * select data
     * @param $sql
     * @return array
     */
    public function selectOne($sql) {
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {

                if($row = $result->fetch_assoc()) {
                    return $row;
                }else {
                    return null;
                }
            } else {
                return null;
            }
        }catch (\Exception $e) {
            error_log("Exception: " . $e->getMessage(), 0);
        }
    }

    /**
     * insert/update/delelte data
     * @param $sql
     * @return bool
     */
    public function update($sql) {
        try {
            if ($this->conn->query($sql) == TRUE) {
                return true;
            } else {
                return false;
            }
        }catch (\Exception $e) {
            error_log("Exception: " . $e->getMessage(), 0);
        }
    }

    /**
     * insert/update/delelte multiple records
     * @param $sql
     * @return bool
     */
    public function multiUpdate($sql) {
        try {
            if ($this->conn->multi_query($sql) == TRUE) {
                return true;
            } else {
                return false;
            }
        }catch (\Exception $e) {
            error_log("Exception: " . $e->getMessage(), 0);
        }
    }

    /**
     * close database connection
     */
    public function close() {
        $this->conn->close();
    }
}