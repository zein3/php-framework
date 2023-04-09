<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use ReflectionClass;
use ReflectionProperty;

abstract class Model
{
    protected $table_name;
    protected $id;

    private function getProperties() {
        $props = (new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC);

        $ret = [];
        foreach ($props as $prop) {
            $ret[$prop->getName()] = $prop->getValue($this);
        }

        return $ret;
    }

    public function save() {
        $properties = $this->getProperties();

        $column_names = implode(',', array_keys($properties));
        $values = implode(',', array_fill(0, count($properties), '?'));

        $sql = "INSERT INTO $this->table_name ($column_names) VALUES ($values)";

        $stmt = Database::getPDO()->prepare($sql);
        $stmt->execute(array_values($properties));

        $this->id = Database::getPDO()->lastInsertId();
    }

    public function update() {

    }

    public function delete() {
        if ($this->id === null)
            return;
        $sql = "DELETE FROM $this->table_name WHERE id=?";
        Database::getPDO()->prepare($sql)->execute([$this->id]);
    }

    public static function getAll() {
        $class = new (get_called_class())();
        $table_name = $class->table_name;

        $sql = "SELECT * FROM $table_name";
        $query = Database::getPDO()->query($sql);
        
        return $query->fetchAll(PDO::FETCH_CLASS, get_called_class());
    }
}