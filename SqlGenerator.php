<?php

class SqlGeneratorInvalidFieldsExceptionKiller extends Exception {
    
}

class SqlGeneratorTableNotExistExceptionNewName extends Exception {
    
}

class SqlGenerator {
    
    protected $tables = array();
    
    public function select($tableName, $fields, $orderField, $orderType) {
        
        if (!isset($this->tables[$tableName])) {
            throw new SqlGeneratorTableNotExistException("Table $tableName does not exist");
        }
        
        foreach ($fields as $field) {
            if (!in_array($field, $this->tables[$tableName])) {
                throw new SqlGeneratorInvalidFieldsException("Field $field does not exist");
            }
        }
        
        
        return 'SELECT ' . join(', ', $fields) . " FROM $tableName ORDER BY $orderField $orderType";        
    }
    
    public function declareTable($tableName, $tableStructure) {
        $this->tables[$tableName] = $tableStructure;
    }
}
