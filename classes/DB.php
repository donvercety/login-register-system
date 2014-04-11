<?php

/**
 * Description of DB
 *
 * @author Tommy Vercety
 */
class DB {

    private static $_instance = NULL;
    private $_pdo,
            $_quety,
            $_error = FALSE,
            $_results,
            $_count = 0,
			$_lastInsertId;

    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
			$this->_pdo->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array()) {
        $this->_error = FALSE;
        if ($this->_quety = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_quety->bindValue($x, $param);
                    $x++;
                }
            }
            if ($this->_quety->execute()) {
				$this->_results = $this->_quety->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_quety->rowCount();
				$this->_lastInsertId = $this->_pdo->lastInsertId();
            }
            else {
                $this->_error = TRUE;
            }
        }

        return $this;
    }

    public function action($action, $table, $where = array()) {
        if (count($where === 3)) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return FALSE;
    }

    public function get($table, $where) {
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where) {
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fields = array()) {

        $keys = array_keys($fields);
        $values = '';
        $x = 1;

        foreach ($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
        
        if (!$this->query($sql, $fields)->error()) {
            return TRUE;
        }

        return FALSE;
    }

    public function update($table, $id, $fields) {
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        if (!$this->query($sql, $fields)->error()) {
            return TRUE;
        }
        return FALSE;
    }

    public function results() {
        return $this->_results;
    }

    public function first() {
        return $this->_results[0];
    }

    public function error() {
        return $this->_error;
    }

    public function count() {
        return $this->_count;
    }
	
	public function getLastInsertId() {
        return $this->_lastInsertId;
    }

}