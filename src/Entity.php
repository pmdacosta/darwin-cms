<?php

abstract class Entity
{
    protected $tableName;
    protected $fields;
    protected $dbc;

    protected function __construct($dbc, $tableName)
    {
        $this->dbc = $dbc;
        $this->tableName = $tableName;
        $this->initFields();
    }

    abstract protected function initFields();

    public function findBy($field, $value)
    {
        $query = "SELECT * FROM $this->tableName where $field = :value";
        $stmt = $this->dbc->prepare($query);
        $stmt->execute(['value' => $value]);

        $data = $stmt->fetch();
        if ($data) {
            $this->setValues($data);
        }
    }

    public function setValues($values)
    {
        foreach ($this->fields as $field) {
            $this->$field = $values[$field];
        }
    }

}