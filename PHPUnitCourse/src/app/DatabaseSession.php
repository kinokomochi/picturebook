<?php
namespace UnitTest\Sample;
class DatabaseSession{

    private $connection = null;
    
    public function __construct($connection){
        $this->connection = $connection;
    }

    public function save ($tableName, $object){
        if (!$tableName || !is_scalar($tableName) || !$object){
            throw new \InvalidArgumentException('$tableName or $object is empty or invalid type');
        }

        if (is_object($object) && $object instanceof \stdClass){
            $object = (array)$object;
        }

        if (!is_array($object)){
            throw new \InvalidArgumentException('$object must be array or \stdClass');
        }

        $values = array_values($object);
        $tableName = '`' . str_replace('`', '\\`', $tableName) . '`';
        $columnBlock = implode(',', array_map(function($col){return '`' . str_replace('`', '\\`', $col) . '`';}, array_keys($object)));
        $valueBlock = implode(',', array_map(function($val){return '?';}, $values));
        $valueMarker = implode('', array_map(function($val){return strval(intval($val)) === strval($val) ? 'i': 's';}, $values));
        $stmt = $this->connection->prepare("REPLACE INTO $tableName($columnBlock) VALUES ($valueBlock);");
        array_unshift($values, $valueMarker);
        $pointer = array();
        foreach ($values as $key => $val){
            $pointer[$key] = &$val;
        }
        call_user_func_array(array($stmt, 'bind_param'), $pointer);
        $stmt->execute();
        $stmt->close();
    }
}