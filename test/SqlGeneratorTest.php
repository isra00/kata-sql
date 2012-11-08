<?php

require __DIR__ . '/../SqlGenerator.php';

class SqlGeneratorTest extends PHPUnit_Framework_TestCase {
    
    protected $sqlGenerator;
    
    public function setUp() {
        $this->sqlGenerator = new SqlGenerator;
        
        $this->sqlGenerator->declareTable('programadores', array(
            'nombre',
            'edad'));
        
        $this->sqlGenerator->declareTable('kata', array('nombre', 'edad'));
    }
    
    public function testInstance() {
        $sqlGenerator = new SqlGenerator;
        $this->assertEquals('SqlGenerator', get_class($sqlGenerator));
    }
    
    public function testSelectUnCampo() {
        $this->assertEquals(
            'SELECT nombre FROM programadores ORDER BY nombre ASC',
            $this->sqlGenerator->select('programadores', 
                    array('nombre'),
                    'nombre', 
                    'ASC'));
    }
    
    public function testSelectDosCampos() {
        $this->assertEquals(
            'SELECT nombre, edad FROM programadores ORDER BY nombre ASC',
            $this->sqlGenerator->select('programadores', 
                    array('nombre', 'edad'), 
                    'nombre', 
                    'ASC'));
    }
    
    public function testSelectOtraTabla() {
        
        $this->assertEquals(
            'SELECT nombre, edad FROM kata ORDER BY nombre ASC',
            $this->sqlGenerator->select('kata', 
                    array('nombre', 'edad'), 
                    'nombre', 
                    'ASC'));
    }
    
    public function testSelectOrder() {
        $this->assertEquals(
            'SELECT nombre, edad FROM kata ORDER BY edad DESC',
            $this->sqlGenerator->select('kata', 
                    array('nombre', 'edad'), 
                    'edad', 
                    'DESC'));
    }
   
    public function testSelectInvalidFields() {
        
        $this->assertEquals('SELECT nombre, edad FROM programadores ORDER BY edad DESC',
                $this->sqlGenerator->select('programadores', 
                array('nombre', 'edad'), 
                'edad', 
                'DESC'));
    }
   
    /**
     * @expectedException SqlGeneratorInvalidFieldsException 
     */
    public function tesstSelectInvalidFieldsOtherTable() {
        $this->sqlGenerator->select('dsfsdfsdsdf', 
                array('dsdsfsdf', 'edad'), 
                'edad', 
                'DESC');
    }
}