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
        if ($this->id !== null) {
            $this->update();
            return;
        }

        $properties = $this->getProperties();

        $column_names = implode(',', array_keys($properties));
        $values = implode(',', array_fill(0, count($properties), '?'));

        $sql = "INSERT INTO $this->table_name ($column_names) VALUES ($values)";

        $stmt = Database::getPDO()->prepare($sql);
        $stmt->execute(array_values($properties));

        $this->id = Database::getPDO()->lastInsertId();
    }

    public function update() {
        if ($this->id === null)
            return;

        $properties = $this->getProperties();
        $columns = "";
        $data = array_values($properties);
        $data[] = $this->id;

        foreach (array_keys($properties) as $property) {
            $columns .= "$property=?,";
        }
        $columns = rtrim($columns, ",");

        $sql = "UPDATE $this->table_name SET $columns WHERE id = ?";

        $stmt = Database::getPDO()->prepare($sql);
        $stmt->execute($data);
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

    public static function get(int $id) {
        $class = new (get_called_class())();
        $table_name = $class->table_name;

        $sql = "SELECT * FROM $table_name WHERE id = ?";
        $query = Database::getPDO()->prepare($sql);
        $query->execute([$id]);

        $query->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $query->fetch();
    }
}