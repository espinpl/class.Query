<?php

# class.Query.php 
# geek.e-spin.pl 

class Query {

private $_id;
private $_table_name;
private $_dbpdo;
private $_parameters = array();

public function __construct($table_name,$id = null) {
try
{
global $pdo;
$this->_dbpdo = $pdo;
$this->_table_name = $table_name; 
$this->_id = $id; 
}    
catch(PDOException $error)
{
return $error->getMessage();
}
}

public function getTable() {
return $this->_table_name;
}
public function getID() {
return $this->_id;
}
public function setField($variable, $value = null) { 
$this->_parameters[$variable] = $value;
}
public function getField() { 
return $this->_parameters;
}
public function getInsertID() {
return $this->_dbpdo->lastInsertId();
}

# sql:INSERT 

public function Insert() 
{
foreach ($this->getField() as $key=>$value) {
$join_fields_name.= $key.',';
$join_fields_value.= "'".$value."',";
}
$join1 = rtrim($join_fields_name, ',');
$join2 = rtrim($join_fields_value, ',');
$add = $this->_dbpdo->exec("INSERT INTO ".$this->getTable()." (".$join1.") VALUES (".$join2.")");
        
if ($add > 0) {
return true;
} else {
return false;
}
    
$add->closeCursor(); 
}

# sql:UPDATE

public function Update() 
{
foreach ($this->getField() as $key=>$value) {
$join_fields.= $key."='".$value."',";
}
$join = rtrim($join_fields, ',');
$update = $this->_dbpdo->exec("UPDATE ".$this->getTable()." SET ".$join." WHERE id='".$this->getID()."'");
        
if ($update > 0) {
return true;
} else {
return false;
}
        
$update->closeCursor(); 
}

# sql:SELECT

public function Select() 
{
foreach ($this->getField() as $key=>$value) {
$join_fields.= $key.',';
}
$join = rtrim($join_fields, ',');
$sel = $this->_dbpdo->query("SELECT ".$join." FROM ".$this->getTable()." WHERE id='".$this->getID()."'");
        
if ($sel > 0) {
return $sel->fetch();
} else {
return false;
}
        
$update->closeCursor(); 
}

# sql:DELETE

public function Remove() {
$delete = $this->_dbpdo->exec("DELETE FROM ".$this->getTable()." WHERE id='".$this->getID()."'");
}

public function RemoveCheck() {
$array = $this->getID();    
if ($array!='') {
foreach($array as $value) { 
$this->_dbpdo->exec("DELETE FROM ".$this->getTable()." WHERE id='$value' LIMIT 1"); 
} 
}
}

public function Clear() {
$clear = $this->_dbpdo->exec("DELETE FROM ".$this->getTable()."");
}

}

?>